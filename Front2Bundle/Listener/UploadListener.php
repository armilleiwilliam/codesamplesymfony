<?php
/**
 * Created by PhpStorm.
 * User: eph
 * Date: 18/03/15
 * Time: 12:00
 */

namespace Casa\Front2Bundle\Listener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use Casa\Front2Bundle\Entity\Foto;
use Casa\Front2Bundle\Entity\Documento;

class UploadListener
{
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    private $router;

    public function __construct($doctrine, $router)
    {
        $this->doctrine = $doctrine;
        $this->router = $router;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $file = $event->getFile();
        /* @var $file \Symfony\Component\HttpFoundation\File\File */

        $request = $event->getRequest();

        $response = $event->getResponse();
        $r = array();

        $em = $this->doctrine->getEntityManager();

  if ($request->get('attachment')) {
      $contratto = $em->getRepository('CasaFront2Bundle:Contratto')->find($request->get('attachment'));
        $documento = new Documento();
       $documento->setFile('upload/'.$contratto->getId().'/documenti/'.$file->move('upload/'.$contratto->getId().'/documenti/',  $file->getFileName())->getFileName());
$documento->setContratto($contratto);
            $r = array(
                'name' => $file->getFilename(),
                'url' => str_replace('app_dev.php/', '', $this->router->generate('home', array(), true)) . 'uploads/attachment/' . $file->getFilename(),
            );
       $documento->setJson($r);
                $em->persist($documento);
                $em->flush();

                

        } elseif ($request->get('contratto_id')) {
            $contratto = $em->getRepository('CasaFront2Bundle:Contratto')->find($request->get('contratto_id'));
/* @var $contratto \Casa\Front2Bundle\Entity\Contratto */
$foto = new Foto();
$foto->setContratto($contratto);
$foto->setFile($file->getFilename());
$foto->setPrincipale(count($contratto->getFoto()) == 0);
            
            $em->persist($foto);
            $em->flush();

            $r = array(
                'name' => $file->getFilename(),
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
                'url' => str_replace('app_dev.php/', '', $this->router->generate('home', array(), true)) . 'uploads/gallery/' . $foto->getFile(),
            );

            // Image sizes (x >= y):
            $size = array(
                'bigImage' => array('x' => 1024, 'y' => 768),
                'mediumImage' => array('x' => 600, 'y' => 400),
                'thumbnail' => array('x' => 300, 'y' => 227),
                'icon' => array('x' => 64, 'y' => 64),
            );

            $this->gdResize($size, $file, $r);
            
            $foto->setJson($r);
                        $em->persist($foto);
            $em->flush();
        } else {
            unlink($file->getRealPath());
            $response['error'] = "File format don't supported";
        }

        $response['files'] = array($r);
    }

    private function icon($type)
    {
        switch ($type) {
            case "application/pdf":
                return "fa-file-pdf-o";
            case "text/plain":
            case "application/rtf":
            case "application/x-rtf":
            case "text/richtext":
                return "fa-file-text-o";
            case "application/msword":
            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                return "fa-file-word-o";
            case "application/excel":
            case "application/vnd.ms-excel":
            case "application/x-excel":
            case "application/x-msexcel":
            case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                return "fa-file-excel-o";
            case "application/x-compressed":
            case "application/x-zip-compressed":
            case "application/zip":
            case "multipart/x-zip":
                return "fa-file-archive-o";
            case "application/mspowerpoint":
            case "application/powerpoint":
            case "application/vnd.ms-powerpoint":
            case "application/x-mspowerpoint":
                return "fa-file-powerpoint-o";
            case "image/jpeg":
            case "image/pjpeg":
            case "image/png":
            case "image/gif":
                return "fa-file-image-o";
            default:
                return "fa-file-o";
        }
    }

    private function gdResize($size, $file, &$r)
    {
        // GD variables:
        list($width, $height, $type) = getimagesize($file->getRealPath());

        $sourceAspect = $width / $height;

        // Image is PNG:
        if ($type == IMAGETYPE_PNG) {
            $image = \imagecreatefrompng($file->getRealPath());
            $valid = true;
        } // Image is JPEG:
        else if ($type == IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($file->getRealPath());
            $valid = true;
        } // Image is GIF:
        else if ($type == IMAGETYPE_GIF) {
            $image = imagecreatefromgif($file->getRealPath());
            $valid = true;
        } // Format not allowed:
        else {
            $valid = false;
        }

        // Start creating images:
        if ($valid) {
            foreach ($size as $key => $data) {
                if ($sourceAspect < 1 && $data['x'] != $data['y']) {
                    $tmp = $data['x'];
                    $data['x'] = $data['y'];
                    $data['y'] = $tmp;
                }
                $aspect = $data['x'] / $data['y'];

                if ($sourceAspect > $aspect) {
                    $temp_height = $data['y'];
                    $temp_width = ( int )($data['y'] * $sourceAspect);
                } else {
                    $temp_width = $data['x'];
                    $temp_height = ( int )($data['x'] / $sourceAspect);
                }

                $temp = imagecreatetruecolor($temp_width, $temp_height);
                imagecopyresampled(
                    $temp,
                    $image,
                    0, 0,
                    0, 0,
                    $temp_width, $temp_height,
                    $width, $height
                );

                $x0 = ($temp_width - $data['x']) / 2;
                $y0 = ($temp_height - $data['y']) / 2;
                $desired = imagecreatetruecolor($data['x'], $data['y']);

                imagecopy(
                    $desired,
                    $temp,
                    0, 0,
                    $x0, $y0,
                    $data['x'], $data['y']
                );

                if (!is_dir($file->getPath() . '/' . $key . '/')) {
                    mkdir($file->getPath() . '/' . $key . '/');
                }

                $url = $file->getPath() . '/' . $key . '/' . $file->getFilename();
                $r[$key . 'Url'] = str_replace('app_dev.php/', '', $this->router->generate('home', array(), true)) . 'uploads/gallery/' . $key . '/' . $file->getFilename();
                $save = imagejpeg($desired, $url, 90);
                imagedestroy($desired);
                imagedestroy($temp);
            }
            imagedestroy($image);

            return $r;


            /*
                                // Watermark images:
                                $mark = imagecreatefrompng("logo.png");
                                list($mwidth, $mheight) = getimagesize("logo.png");
                                $img = imagecreatefromjpeg($targetFile . '_big.jpg');

                                list($bwidth, $bheight) = getimagesize($targetFile . '_big.jpg');
                                imagecopy($img, $mark, $bwidth - $mwidth - 25, $bheight - $mheight - 25, 0, 0, $mwidth, $mheight);
                                imagejpeg($img, $targetFile . '_big.jpg', 100);
                                imagedestroy($img);
            */
        }
    }
}