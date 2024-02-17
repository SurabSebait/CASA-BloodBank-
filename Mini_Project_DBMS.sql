DROP DATABASE BloodBank;
CREATE DATABASE BloodBank;
USE BloodBank;

CREATE TABLE Recipient ( Rec_ID INT PRIMARY KEY AUTO_INCREMENT, Rec_Name VARCHAR(120) NOT NULL, Rec_DoB DATE NOT NULL,
                         Rec_Gender VARCHAR(20) NOT NULL, Rec_Blood_Type VARCHAR(20) NOT NULL,
                         Rec_Email VARCHAR(120) NOT NULL, Rec_Phone_No BIGINT NOT NULL);
                        
          
CREATE TABLE Donor ( D_ID INT PRIMARY KEY AUTO_INCREMENT, D_Name VARCHAR(120) NOT NULL,
					 D_DoB DATE NOT NULL, D_Gender VARCHAR(20) NOT NULL, D_Blood_Type VARCHAR(20) NOT NULL,
                     D_Email VARCHAR(120) NOT NULL, D_Phone_No BIGINT NOT NULL,
                     Last_Date_of_Donation DATE DEFAULT NULL, Medical_History VARCHAR(150) DEFAULT NULL);
  
INSERT INTO donor VALUES (7, 'XYzzza', '1982-09-18', 'Male', 'B+', 'xyz@example.com', 1234567891, '2022-10-15', 'No major health issues');
  
  
  
SELECT * FROM Donor;


CREATE TABLE Blood_Bank (Bank_ID INT PRIMARY KEY AUTO_INCREMENT, Bank_Name VARCHAR(120) NOT NULL, 
						 Location VARCHAR(20) NOT NULL, Bank_Email VARCHAR(120) NOT NULL, 
                         Bank_Phone_No BIGINT NOT NULL, Mgr_ID INT);
                         
-- CREATE TABLE Staff (S_ID int Primary Key auto_increment, Bank_ID int NOT NULL, S_Name varchar(120) NOT NULL,
-- 					S_Position varchar(20) NOT NULL, S_Email varchar(120) NOT NULL, 
--                     S_Phone_No bigint NOT NULL, 
--                     FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID) );


CREATE TABLE Staff (S_ID INT PRIMARY KEY AUTO_INCREMENT, Bank_ID INT NOT NULL, S_Name VARCHAR(120) NOT NULL,
					S_Position VARCHAR(40) NOT NULL, S_Email VARCHAR(120) NOT NULL UNIQUE, S_Password VARCHAR(40) NOT NULL,
                    S_Phone_No BIGINT NOT NULL, FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID));
   
select * from staff;

ALTER TABLE Blood_Bank ADD FOREIGN KEY (Mgr_ID) REFERENCES Staff(S_ID);

CREATE TABLE Blood_Inventory  ( Bld_Bag_ID BIGINT PRIMARY KEY AUTO_INCREMENT, D_ID INT NOT NULL, 
								Bank_ID INT NOT NULL,
								Date_of_Donatn DATE, Quantity INT NOT NULL,
								Price INT, Don_Status VARCHAR(20) NOT NULL,
								FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID),
								FOREIGN KEY (D_ID) REFERENCES Donor(D_ID) );
SELECT * FROM Blood_Inventory;

CREATE TABLE Transfusion ( T_ID INT PRIMARY KEY AUTO_INCREMENT, Bag_ID BIGINT NOT NULL,
						   Rec_ID INT NOT NULL,
						   T_Date DATE NOT NULL, Quantity INT NOT NULL, T_time TIME,
                           FOREIGN KEY (Bag_ID) REFERENCES Blood_Inventory(Bld_Bag_ID),
                           FOREIGN KEY (Rec_ID) REFERENCES Recipient(Rec_ID) );
                           

                        
-- Insert records into the Recipient table
INSERT INTO Recipient (Rec_ID, Rec_Name, Rec_DoB, Rec_Gender, Rec_Blood_Type, Rec_Email, Rec_Phone_No)
VALUES
  (1, 'John Doe', '1990-05-15', 'Male', 'A+', 'john@example.com', 1234567890),
  (2, 'Jane Smith', '1985-12-10', 'Female', 'B-', 'jane@example.com', 9876543210),
  (3, 'Robert Johnson', '1978-08-22', 'Male', 'O-', 'robert@example.com', 5555555555),
  (4, 'Susan White', '1993-03-30', 'Female', 'AB+', 'susan@example.com', 7777777777),
  (5, 'Michael Brown', '1987-11-05', 'Male', 'A-', 'michael@example.com', 9999999999);

-- Insert records into the Donor table
INSERT INTO Donor (D_ID, D_Name, D_DoB, D_Gender, D_Blood_Type, D_Email, D_Phone_No, Last_Date_of_Donation, Medical_History)
VALUES
  (1, 'David Davis', '1982-09-18', 'Male', 'B+', 'david@example.com', 1234567891, '2022-10-15', 'No major health issues'),
  (2, 'Linda Wilson', '1990-04-12', 'Female', 'B-', 'linda@example.com', 9876543211, '2022-09-25', 'High cholesterol'),
  (3, 'William Harris', '1988-06-25', 'Male', 'O-', 'william@example.com', 5555555556, '2022-11-05', 'No known issues'),
  (4, 'Patricia Clark', '1995-02-08', 'Female', 'AB+', 'patricia@example.com', 7777777778, '2022-10-01', 'Asthma'),
  (5, 'Richard Lee', '1985-12-02', 'Male', 'A-', 'richard@example.com', 9999999991, '2022-09-15', 'No major health issues');
  
INSERT INTO Donor (D_Name, D_DoB, D_Gender, D_Blood_Type, D_Email, D_Phone_No, Medical_History)
	VALUES ('Surab Sebait', '2005-04-18', 'Male', 'B+', 'surabsebait@gmail.com', 9087637483, 'NA');

-- Insert records into the Blood_Bank table
INSERT INTO Blood_Bank 
VALUES
  (1, 'City Blood Center', '123 Main St', 'cityblood@example.com', 1111111111, NULL),
  (2, 'County Blood Bank', '456 Oak Ave', 'countyblood@example.com', 2222222222, NULL ),
  (3, 'Regional Blood Bank', '789 Elm St', 'regionalblood@example.com', 3333333333, NULL),
  (4, 'Community Blood Bank', '101 Pine Rd', 'communityblood@example.com', 4444444444, NULL),
  (5, 'Central Blood Bank', '567 Cedar Ave', 'centralblood@example.com', 5555555555, NULL);

INSERT INTO Blood_Inventory VALUES (172111799, 4, 2, '2023-11-05', 1, 55, 'Availiable');

-- Insert records into the Staff table
-- INSERT INTO Staff 
-- VALUES
--  (1, 1, 'Michael Smith', 'Manager', 'michael@example.com', 1111111112),
--   (2, 2, 'Lisa Johnson', 'Nurse', 'lisa@example.com', 2222222223),
--   (3, 3, 'John Davis', 'Technician', 'john@example.com', 3333333334),
--   (4, 4, 'Susan Wilson', 'Nurse', 'susan@example.com', 4444444445),
--   (5, 5, 'David Brown', 'Technician', 'david@example.com', 5555555556);
DROP TABLE Staff;
INSERT INTO Staff 
VALUES
  (1, 1, 'Michael Smith', 'Manager', 'michael@gmail.com', '1234', 1111111112),
  (2, 2, 'Lisa Johnson', 'Nurse', 'lisa@example.com', '1234', 2222222223),
  (3, 3, 'John Davis', 'Technician', 'john@example.com', '1234', 3333333334),
  (4, 4, 'Susan Wilson', 'Nurse', 'susan@example.com', '1234', 4444444445),
  (5, 5, 'Arnav Khadkatkar', 'Admin', 'akhadkatkar@gmail.com', '1234', 5555555556);

INSERT INTO Staff 
VALUES
  (6, 1, 'Chidrupee Kalle', 'User', 'chidrupeekalle@gmail.com', '1234', 23454674543);
-- Update records in Blood_Bank

UPDATE Blood_Bank 
	SET Mgr_ID = 1
		WHERE Bank_ID = 1;

SELECT * FROM blood_bank;

-- Insert records into the Blood_Inventory table
INSERT INTO Blood_Inventory
VALUES
  (123456789, 1, 1, '2022-10-15', 1, 50, 'Available'),
  (987654321, 2, 2, '2022-09-25', 2, 60, 'Available'),
  (111111111, 3, 3, '2022-11-05', 1, 55, 'Available'),
  (222222222, 4, 4, '2022-10-01', 3, 70, 'Available'),
  (333333333, 5, 5, '2022-09-15', 2, 50, 'Available');


-- Insert records into the Transfusion table
INSERT INTO Transfusion 
VALUES
  (1, 123456789, 1, '2023-10-20', 2, '08:30:00'),
  (2, 987654321, 2, '2023-09-15', 4, '14:15:00'),
  (3, 111111111, 3, '2023-11-02', 3, '11:45:00'),
  (4, 222222222, 4, '2023-10-10', 5, '16:20:00'),
  (5, 333333333, 5, '2023-09-28', 2, '10:30:00');

INSERT INTO transfusion VALUES (23270, 172111799, 3, '2023-10-20', 2, '08:30:00');

SELECT * FROM donor; 

-- Triggers 

-- Trigger to update Last Date of Donation of Donor

DELIMITER //
CREATE TRIGGER UpdateLastDonationDate
AFTER INSERT ON Blood_Inventory
FOR EACH ROW
BEGIN
  UPDATE Donor
  SET Last_Date_of_Donation = NEW.Date_of_Donatn
  WHERE D_ID = NEW.D_ID;
END//

DELIMITER ;

-- DROP TRIGGER UpdateLastDonationDate;

SELECT * FROM Donor 
WHERE D_ID = 1;

-- INSERT INTO Blood_Inventory VALUES (123456799, 1, 2, '2023-10-10', 1, 50, 'Pending');


-- TRUNCATE TABLE Donor;
-- TRUNCATE TABLE donation;

-- Trigger to Check if Donor's Last Date of Donation was before 90 days

DELIMITER //

CREATE TRIGGER CheckEligibilty
BEFORE INSERT ON Blood_Inventory
FOR EACH ROW 
	BEGIN 
		DECLARE Last_donatn DATE;
        
        SELECT Last_Date_of_Donation INTO Last_donatn
        FROM Donor d
        WHERE D_ID = NEW.D_ID;
        
		IF Last_Donatn IS NOT NULL AND DATEDIFF(CURDATE(),Last_Donatn) < 90 THEN 
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Person can only donate 90 days after his last donation';
		END IF;
        
    END //
    
    
    

DELIMITER ;

-- DROP TRIGGER CheckEligiblity;

-- DROP TRIGGER CheckEligibilty;



DELIMITER ;
    
SELECT * FROM donor;


-- Trigger to maintain data integrity :

-- Blood Type should be same for the Donor and the Recipient

-- DELIMITER //

-- CREATE TRIGGER SameBloodTypeDonorandRecipient
-- BEFORE INSERT ON Transfusion
-- FOR EACH ROW 
-- 	BEGIN 
-- 		DECLARE RecipientBloodType varchar(20);
--         DECLARE DonorBloodType varchar(20);
--         SELECT Rec_Blood_Type INTO RecipientBloodType FROM Recipient WHERE Rec_ID = NEW.Rec_ID;
--         SELECT d.D_Blood_Type INTO DonorBloodType 
--         FROM Donor d ,donation dn ,transfusion t ,Blood_Bank b
-- 		WHERE t.Bank_ID = b.Bank_ID AND 
-- 			  b.Bank_ID = dn.Bank_ID AND 
-- 			  dn.D_ID = d.D_ID AND 
-- 			  t.Rec_ID = NEW.Rec_ID ;
              
--              IF RecipientBloodType <> DonorBloodType THEN 
-- 				SIGNAL SQLSTATE '45000'
-- 				SET MESSAGE_TEXT = 'Recipient and Donor Blood Types do not match.';
--               END IF;          

-- 	END //
    
DELIMITER ;

-- drop trigger SameBloodTypeDonorandRecipient;

INSERT INTO donation VALUES (723456799, 398, 2, '2022-10-10', 1, 50, 'Pending');

-- DROP TRIGGER Donor_in_donatn_chk;

SELECT * FROM Recipient WHERE Rec_ID = 1;

SELECT *  
        FROM Donor d ,Donation dn ,Transfusion t ,Blood_Bank b
		WHERE t.Bank_ID = b.Bank_ID AND 
			  b.Bank_ID = dn.Bank_ID AND 
			  dn.D_ID = d.D_ID AND 
			  t.Rec_ID = 1 ;

INSERT INTO transfusion VALUES (10, 2, 3, '2023-09-30', 30, '08:30:00');


-- Trigger to Check if Age > 18

DELIMITER //

CREATE TRIGGER AgeChk
BEFORE INSERT ON Donor
FOR EACH ROW 
	BEGIN
		IF ((DATEDIFF(CURDATE(), NEW.D_DoB)) / 365 ) < 18 THEN 
        SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Age of Donor must be above 18';
		END IF;
        
	END//
    
DELIMITER ;

INSERT INTO Donor VALUES (32, 'David Davis', '2022-09-18', 'Male', 'B+', 'david@example.com', 1234567891, '2022-10-15', 'No major health issues');

-- drop trigger AgeChk;


INSERT INTO recipient VALUES (90, 'Mikey', '1987-11-05', 'Male', 'A+', 'mikey@example.com', 8999999999);

INSERT INTO Blood_Inventory VALUES (892222222, 3, 3, '2022-11-05', 1, 55, 'Available');

INSERT INTO transfusion VALUES (20, 892222222, 90, '2023-10-10', 5, '16:20:00');

-- DROP TRIGGER SameBloodTypeDonorandRecipient;

-- Trigger to Update Status of Blood Bag
DELIMITER //



INSERT INTO Blood_Inventory
VALUES
  (123456788, 4, 4, '2022-10-15', 1, 50, 'Available');
  

INSERT INTO Transfusion 
VALUES
  (899, 123456788, 1, '2023-10-20', 2, '08:30:00');
  
-- drop trigger UpdateStatus;

SELECT * FROM Blood_Inventory WHERE Bld_Bag_ID = 123456776;

-- Trigger to Update the Status from 'Available' to 'Unavailable'

DELIMITER //
CREATE TRIGGER UpdateStatus
AFTER INSERT ON Transfusion
FOR EACH ROW
BEGIN
    DECLARE Bag_Status VARCHAR(20);
    
    -- Get the status of the blood bag
    SELECT Don_Status INTO Bag_Status
    FROM Blood_Inventory
    WHERE Bld_Bag_ID = NEW.Bag_ID;

    -- Update the status to "Unavailable" if it was "Available"

        UPDATE Blood_Inventory
        SET Don_Status = 'Unavailable'
        WHERE Bld_Bag_ID = NEW.Bag_ID;

END//
DELIMITER ;

SELECT * FROM Blood_Inventory;

-- Trigger to not allow the Usage of Unavailable Bags

DELIMITER //

CREATE TRIGGER NoUsingUnavail
BEFORE INSERT ON transfusion
FOR EACH ROW
BEGIN 
	DECLARE Bag_Status VARCHAR(20); 
	SELECT b.Don_Status INTO Bag_Status
    FROM Blood_Inventory b
    WHERE Bld_Bag_ID = NEW.Bag_ID;
    
    IF Bag_Status = 'Unavailable' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'This Blood Bag is Unavailable';
	END IF;
        
	END//
    

DELIMITER ;

-- DROP TRIGGER NoUsingUnavail;

INSERT INTO transfusion VALUES (32141, 172111799, 2, '2023-10-20', 2, '08:30:00');

-- Trigger to maintain data integrity :

-- Trigger to Check Blood Type of Donor and Recipient

DELIMITER //

 CREATE TRIGGER SameBloodTypeDonandRec
 BEFORE INSERT ON transfusion 
 FOR EACH ROW 
 BEGIN 
	DECLARE Don_Blood_Type VARCHAR(20);
    DECLARE Rec_Blood_Type VARCHAR(20);
    
    SELECT d.D_Blood_Type INTO Don_Blood_Type
    FROM  Donor d, Blood_Inventory b
    WHERE d.D_ID = b.D_ID AND 
		  b.Bld_Bag_ID = NEW.Bag_ID;
          
	SELECT r.Rec_Blood_Type INTO Rec_Blood_Type
    FROM Recipient r, transfusion t
    WHERE r.Rec_ID = t.Rec_ID AND 
		  t.Rec_ID = NEW.Rec_ID;
          
	IF Don_Blood_Type <> Rec_Blood_Type THEN 
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
	END IF;
        
	END//
	
 DELIMITER ;   
 
 SELECT * FROM Blood_Inventory;
 
 SELECT * FROM Transfusion;
 
 -- DROP TRIGGER ExpiredCheck;
 INSERT INTO transfusion VALUES (135515, 111111199, 1, '2023-10-20', 2, '08:30:00');
 
 SELECT * FROM Donor;
 
 SELECT * FROM Recipient;
 
 
  -- DROP TRIGGER SameBloodTypeDonandRec;
 
 INSERT INTO transfusion VALUES (54626, 111111111, 4, '2023-10-20', 2, '08:30:00');
 
 -- Trigger to Check Blood Type of Donor and Recipient (More Precise)

-- DELIMITER //

--  CREATE TRIGGER SameBloodTypeDonandRec
-- BEFORE INSERT ON transfusion 
-- FOR EACH ROW 
--  BEGIN 
-- 	DECLARE Don_Blood_Type varchar(20);
--    DECLARE Rec_Blood_Type varchar(20);
    
--    SELECT d.D_Blood_Type INTO Don_Blood_Type
--    FROM  Donor d, Blood_Inventory b
--    WHERE d.D_ID = b.D_ID AND 
-- 		  b.Bld_Bag_ID = NEW.Bag_ID;
          
-- 	SELECT r.Rec_Blood_Type INTO Rec_Blood_Type
--    FROM Recipient r, transfusion t
--    WHERE r.Rec_ID = t.Rec_ID AND 
-- 		  r.Rec_ID = NEW.Rec_ID;
          
-- 	IF Rec_Blood_Type = 'A+' AND Don_Blood_Type NOT IN ('A+', 'A-', 'O+', 'O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'A-' AND Don_Blood_Type NOT IN ('A-','O-')THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'B+' AND Don_Blood_Type NOT IN ('B+','B-', 'O+', 'O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'B-' AND Don_Blood_Type NOT IN ('B-','O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'AB-' AND Don_Blood_Type NOT IN ('AB-','A-', 'B-', 'O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'O+' AND Don_Blood_Type NOT IN ('O+', 'O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;
    
--     IF Rec_Blood_Type = 'O-' AND Don_Blood_Type NOT IN ('O-') THEN 
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT = 'The Donor and Recipient Blood Types are not compatible.';
-- 	END IF;    
	
-- 	END//
	
--  DELIMITER ; 
 
 -- Trigger to Check if Blood Bag has expired before Transfusion
 
 DELIMITER //
 
 CREATE TRIGGER ExpiredCheck
 BEFORE INSERT ON Transfusion
 FOR EACH ROW
 BEGIN 
	DECLARE Donation_Date DATE;
    SELECT b.Date_of_Donatn INTO Donation_Date 
    FROM Blood_Inventory b
    WHERE b.Bld_Bag_ID = NEW.Bag_ID;
          
	IF DATEDIFF(NEW.T_Date, Donation_Date) > 42 THEN 
    SIGNAL SQLSTATE '45000'
	SET MESSAGE_TEXT = 'Blood Bag has expired';
	
    UPDATE Blood_Inventory
    SET Don_Status = 'Unavailable'
    WHERE Bld_Bag_ID = NEW.Bag_ID;
        
	END IF;
        
	END//

DELIMITER ;
          
INSERT INTO transfusion VALUES (143526, 333333333, 3, '2023-10-15', 12, '08:30:00');
 
-- DROP TRIGGER SameBloodTypeDonandRec;

