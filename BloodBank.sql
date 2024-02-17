drop database BloodBank;
create database BloodBank;
use BloodBank;

CREATE TABLE Recipient ( Rec_ID int Primary Key auto_increment, Rec_Name varchar(120) NOT NULL, Rec_DoB date NOT NULL,
                         Rec_Gender varchar(20) NOT NULL, Rec_Blood_Type varchar(20) NOT NULL,
                         Rec_Email varchar(120) NOT NULL, Rec_Phone_No bigint NOT NULL);
                        
          
CREATE TABLE Donor ( D_ID int Primary Key auto_increment, D_Name varchar(120) NOT NULL,
					 D_DoB date NOT NULL, D_Gender varchar(20) NOT NULL, D_Blood_Type varchar(20) NOT NULL,
                     D_Email varchar(120) NOT NULL, D_Phone_No bigint NOT NULL,
                     Last_Date_of_Donation date default NULL, Medical_History varchar(150) default NULL);
  
select * from Donor;


CREATE TABLE Blood_Bank (Bank_ID int Primary Key auto_increment, Bank_Name varchar(120) NOT NULL, 
						 Location varchar(20) NOT NULL, Bank_Email varchar(120) NOT NULL, 
                         Bank_Phone_No bigint NOT NULL, Mgr_ID int);
                         
CREATE TABLE Staff (S_ID int Primary Key auto_increment, Bank_ID int NOT NULL, S_Name varchar(120) NOT NULL,
					S_Position varchar(20) NOT NULL, S_Email varchar(120) NOT NULL, 
                    S_Phone_No bigint NOT NULL, 
                    FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID) );
                    
ALTER TABLE Blood_Bank ADD FOREIGN KEY (Mgr_ID) REFERENCES Staff(S_ID);

CREATE TABLE Transfusion ( T_ID int Primary Key auto_increment, Bank_ID int NOT NULL, Rec_ID int NOT NULL,
						   T_Date date NOT NULL, Quantity int NOT NULL, T_time time,
                           FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID),
                           FOREIGN KEY (Rec_ID) REFERENCES Recipient(Rec_ID) );
                           
CREATE TABLE donation ( Bld_Bag_ID bigint Primary Key auto_increment, D_ID int NOT NULL, 
						Bank_ID int NOT NULL, D_Blood_Type varchar(20) NOT NULL,
						Date_of_Donatn date, Quantity int NOT NULL,
						 Price int, Don_Status varchar(20) NOT NULL,
						FOREIGN KEY (Bank_ID) REFERENCES Blood_Bank(Bank_ID),
						FOREIGN KEY (D_ID) REFERENCES Donor(D_ID) );
                        
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
  (1, 'David Davis', '1982-09-18', 'Male', 'A+', 'david@example.com', 1234567891, '2023-10-15', 'No major health issues'),
  (2, 'Linda Wilson', '1990-04-12', 'Female', 'B-', 'linda@example.com', 9876543211, '2023-09-30', 'High cholesterol'),
  (3, 'William Harris', '1988-06-25', 'Male', 'O-', 'william@example.com', 5555555556, '2023-10-01', 'No known issues'),
  (4, 'Patricia Clark', '1995-02-08', 'Female', 'AB+', 'patricia@example.com', 7777777778, '2023-09-20', 'Asthma'),
  (5, 'Richard Lee', '1985-12-02', 'Male', 'A-', 'richard@example.com', 9999999991, '2023-10-05', 'No major health issues');
  
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

-- Insert records into the Staff table
INSERT INTO Staff 
VALUES
  (1, 1, 'Michael Smith', 'Manager', 'michael@example.com', 1111111112),
  (2, 2, 'Lisa Johnson', 'Nurse', 'lisa@example.com', 2222222223),
  (3, 3, 'John Davis', 'Technician', 'john@example.com', 3333333334),
  (4, 4, 'Susan Wilson', 'Nurse', 'susan@example.com', 4444444445),
  (5, 5, 'David Brown', 'Technician', 'david@example.com', 5555555556);
  

-- Update records in Blood_Bank

UPDATE Blood_Bank 
	SET Mgr_ID = 1
		WHERE Bank_ID = 1;

select * from blood_bank;


-- Insert records into the Transfusion table
INSERT INTO Transfusion 
VALUES
  (1, 1, 1, '2023-10-20', 2, '08:30:00'),
  (2, 2, 2, '2023-09-15', 4, '14:15:00'),
  (3, 3, 3, '2023-11-02', 3, '11:45:00'),
  (4, 4, 4, '2023-10-10', 5, '16:20:00'),
  (5, 5, 5, '2023-09-28', 2, '10:30:00');

-- Insert records into the donation table
INSERT INTO donation 
VALUES
  (123456789, 1, 1, 'O+', '2023-10-10', 1, 50, 'Approved'),
  (987654321, 2, 2, 'A-', '2023-09-25', 2, 60, 'Pending'),
  (111111111, 3, 3, 'B+', '2023-11-05', 1, 55, 'Approved'),
  (222222222, 4, 4, 'AB-', '2023-10-01', 3, 70, 'Approved'),
  (333333333, 5, 5, 'O+', '2023-09-15', 2, 50, 'Pending');

select * from donor; 

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


-- Trigger to Check if Donor's Last Date of Donation was before 90 days

DELIMITER //

CREATE TRIGGER CheckEligibilty
BEFORE INSERT ON Donor
FOR EACH ROW 
	BEGIN 
		
		IF NEW.Last_Date_of_Donation IS NOT NULL AND datediff(CURDATE(), NEW.Last_Date_of_Donation) < 90 THEN 
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Person can only donate 90 days after his last donation';
		END IF;
        
  END //
    
DELIMITER ;

-- Trigger to Check if Age > 18

DELIMITER //

CREATE TRIGGER AgeChk
BEFORE INSERT ON Donor
FOR EACH ROW 
	BEGIN
		IF ((datediff(CURDATE(), NEW.D_DoB)) / 365 ) < 18 THEN 
        SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Age of Donor must be above 18';
		END IF;
        
	END//
    
DELIMITER ;