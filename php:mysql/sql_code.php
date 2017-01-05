
  **/
  *  SQL code
  *  - Creating a dashboard with the last year goals and today goal for a travel agency
  */

	USE Sunspot 
               DECLARE @StartOFYearDate DATETIME = CAST(GETDATE() AS DATE) 
               DECLARE @YesterdayDate DATETIME = dateadd(day,datediff(day,1,GETDATE()),0) 
               DECLARE @TomorrowdayDate DATETIME = dateadd(day,1,0) 
               DECLARE @TodayDateTime DATETIME = GETDATE()
               DECLARE @TodayDate DATETIME = CAST(GETDATE() AS DATE) 
               DECLARE @StartOfMonthDate DATETIME = DATEADD(month, DATEDIFF(month, 0,GETDATE()), 0) 
               DECLARE @EndOfMonthDate DATETIME = DATEADD(s,-1,DATEADD(mm, DATEDIFF(m,0,GETDATE())+1,0))
             DECLARE @EndOfMonthDateLasYear DATETIME = DATEADD(month, DATEDIFF(month, 0, DATEADD(year,-1,GETDATE())), 0)
               DECLARE @LastYearToday DATETIME = dateadd(day,datediff(day,0, DATEADD(year,-1,GETDATE())), CONCAT(DATEPART(hh,@TodayDateTime),':',DATEPART(mi,@TodayDateTime),':',DATEPART(ss,@TodayDateTime)))
               DECLARE @LastYearTodayBeginDay DATETIME = dateadd(day,datediff(day,0, DATEADD(year,-1,GETDATE())), '00:00:00')
               DECLARE @LastYearTodayEndDay DATETIME = dateadd(day,datediff(day,0, DATEADD(year,-1,GETDATE())), '23:59:59')
               DECLARE @now DateTime SET @now = Convert(date, getdate())
       DECLARE @SameDayOfTheWeek DATETIME = DATEADD(day, (DATEPART(week, @now) * 7 + DATEPART(weekday, @now)) - (DATEPART(week, DATEADD(year, -1, @now)) * 7 + DATEPART(weekday, DATEADD(year, -1, @now))), DATEADD(year, -1, @now))
         DECLARE @SameDayOfTheWeekYesterday DATETIME = dateadd(day,datediff(day,1,@SameDayOfTheWeek),0)

               Select 
                        DISTINCT (SELECT SUM(dbM.M_AdultsAndChildren) FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                WHERE dbM.MI_BookingStatusID IN (1,2,3) AND @TodayDate = CAST(dMD.DATE as DATE) group by dMD.DATE) as TotPaxToday, 
                        (Select COUNT(*) FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                WHERE dbM.MI_BookingStatusID IN (1,2,3) AND @TodayDate = CAST(dMD.DATE as DATE) group by dMD.DATE)  AS BOOKINGS,
                (Select MAX(TotPassengers) from (Select SUM(dbM.M_AdultsAndChildren - dbM.M_Infants) as TotPassengers,
                        dbMS.UserName as UserName
               FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                        LEFT JOIN dbo.SystemUser as dbMS on (dbM.MI_SystemUserID = dbMS.SystemUserID)
               WHERE dMD.DATE >= @YesterdayDate 
                        AND dMD.DATE < @TodayDate
                       AND dbM.MI_BookingStatusID IN (1,2,3) group by dbMS.UserName) AS TopSeller) as TopSeller,
                        (Select TopSelName from (Select TOP(1)
                                dbMS.UserName as TopSelName,
                                SUM(dbM.M_AdultsAndChildren) AS TotPass
               FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                        LEFT JOIN dbo.SystemUser as dbMS on (dbM.MI_SystemUserID = dbMS.SystemUserID)
               WHERE dMD.DATE = @YesterdayDate 
                AND dbM.MI_BookingStatusID IN (1,2,3) group By dbMS.UserName order by TotPass desc) as TopSelName) as TopSelName,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengersTwo 
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE dMD.DATE >= @YesterdayDate 
                        AND dMD.DATE < @TodayDate 
                        AND dbM.MI_BookingStatusID IN (1,2,3) group by dMD.DATE) as TotPaxYest,
                                (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers 
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE dMD.DATE >= @YesterdayDate 
                        AND dMD.DATE < @TodayDate 
                        AND dbM.MI_BookingStatusID IN (4) group by dMD.DATE) as TotPaxCanc,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE @TodayDate = CAST(dMD.DATE as DATE) 
                        AND dbM.MI_BookingStatusID IN (1,2,3) 
                        AND dbM.MI_SystemUserID = 152 group by dMD.DATE) as TotPaxWeb,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassenger
               FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE dMD.DATE >= @YesterdayDate 
                        AND dMD.DATE < @TodayDate   
                        AND dbM.MI_SystemUserID = 152 
                        AND dbM.MI_BookingStatusID IN (1,2,3) group by dMD.DATE) as TotPaxWebYest,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE @TodayDate = CAST(dMD.DATE as DATE) 
                        AND dbM.MI_BookingStatusID IN (1,2,3) 
                        AND dbM.MI_SalesChannelID = 1 group by dMD.DATE) as TotPaxCallToday,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
               FROM dbo.MIDV_Booking as dbM 
                        LEFT JOIN dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               WHERE dMD.DATE >= @YesterdayDate 
                        AND dMD.DATE < @TodayDate 
                        AND dbM.MI_SalesChannelID = 1 
                        AND dbM.MI_BookingStatusID IN (1,2,3) group by dMD.DATE) as TotPaxCallYest,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMon,
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_TradeID = 0 
                        AND dbM.MI_BrandID NOT IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonDirect,                                
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @EndOfMonthDateLasYear 
                        AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_TradeID = 0 
                        AND dbM.MI_BrandID NOT IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonDirectYTD,                             
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_TradeID <> 0
                        AND dbM.MI_BrandID NOT IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonTrade,                                          
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @EndOfMonthDateLasYear 
                        AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_TradeID > 0
                        AND dbM.MI_BrandID NOT IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonTradeYTD,                              
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_BrandID IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonIrish,                        
                        
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @EndOfMonthDateLasYear 
                        AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_BrandID IN(7,8,9,15,17,18,19,32,31)
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBegMonIrishYTD,                              
                                                  
                        (Select 
               SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE >= @EndOfMonthDateLasYear 
                        AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxBenMonLasYear,
                        (Select 
               SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE = @SameDayOfTheWeek
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxTodayLastYear,
                        (Select 
               SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
               where dMD.DATE = @SameDayOfTheWeekYesterday
                        AND dbM.MI_BookingStatusID IN (1,2,3)) AS TotPaxTodayLastYearYesterday,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                     left join dbo.MIDV_ExtraBooking as Meb on (Meb.P_BookingReference = dbM.P_BookingReference)
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_BookingStatusID IN (1,3)
                        AND Meb.MI_ExtraTypeID IN (9, 8, 23, 10, 1, 80, 81)) AS InsuranceToDate,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                     left join dbo.MIDV_ExtraBooking as Meb on (Meb.P_BookingReference = dbM.P_BookingReference)
               where dMD.DATE >= @EndOfMonthDateLasYear 
               AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_BookingStatusID IN (1,3)
                        AND Meb.MI_ExtraTypeID IN (9, 8, 23, 10, 1, 80, 81)) AS InsuranceToDateLastYear,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                     left join dbo.MIDV_ExtraBooking as Meb on (Meb.P_BookingReference = dbM.P_BookingReference)
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime
                        AND dbM.MI_BookingStatusID IN (1,2,3)
                       AND Meb.MI_ExtraTypeID IN (20)) AS VisaBegMonth,
                        (Select 
                        SUM(dbM.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                     left join dbo.MIDV_ExtraBooking as Meb on (Meb.P_BookingReference = dbM.P_BookingReference)
               where dMD.DATE >= @EndOfMonthDateLasYear 
               AND dMD.DATE < @LastYearToday 
                        AND dbM.MI_BookingStatusID IN (1,2,3)
                        AND Meb.MI_ExtraTypeID IN (20)) AS VisaBegMonthLastYear,
                       (Select 
                        SUM(Meb.M_AdultsAndChildren) as TotPassengers
       FROM dbo.MIDV_Booking as dbM left join dbo.MI_DATE as dMD on (dbM.MI_BookingDate_DateID = dMD.MI_DateID) 
                        left join dbo.MIDV_MSBooking as Meb on (Meb.P_BookingReference = dbM.P_BookingReference)
               where dMD.DATE >= @StartOfMonthDate 
                        AND dMD.DATE < @TodayDateTime