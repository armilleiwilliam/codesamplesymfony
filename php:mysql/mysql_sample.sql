  
/**
 * Query to retrieve a tour info from a database
 *
 **/
   
    SELECT 
        bp.TourPackageID,
        DepartureDate,
        ap.airportname,
        bp.DepartingFrom,
        bp.DepartureDate,
        gtd.price,
        gt.`mainTourID`
    FROM booking_et.packages bp
         LEFT JOIN global.`tourdefinitions` gt ON bp.DefinitionID = gt.`id`
         LEFT JOIN global.airports AS ap ON(ap.airportcode = bp.DepartingFrom)
    LEFT JOIN global.`tourdap` AS gtd ON(gtd.mainTourID = gt.`mainTourID` AND gtd.fromDate = bp.DepartureDate)
         LEFT JOIN global.tourmain AS gtm ON (gt.`mainTourID` = gtm.id)
         LEFT JOIN global.destinations AS gd ON(gd.tourRegionID = gtm.tourRegionID)
    WHERE  gt.`mainTourID` =:id AND bp.Active = 1 AND bp.VerifiedFailed = 0 AND PackageCategory = 'Main'
    AND ADDDATE(bp.DepartureDate, INTERVAL gd.tourAdvanceCutOff DAY) > NOW() GROUP BY bp.TourPackageID;