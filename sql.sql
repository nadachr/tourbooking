DROP PROCEDURE `searchPackage`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchPackage`(IN `search` VARCHAR(50)) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN
	DECLARE kw VARCHAR(50);
    SET kw = CONCAT('%',search,'%');
	SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, "%d/%m/%Y") dstart,
    numSeat - numBooking numFree
    FROM `tbpacktour` t
    INNER JOIN tbplanning p
    ON p.ref_pktourid = t.pktourid
	WHERE pktourid LIKE kw OR pktourname LIKE kw OR pkdetail LIKE kw OR unitprice LIKE kw OR datestart LIKE kw;

END