// Hur många av olika rang?

SELECT COUNT(*), Rank FROM crew GROUP BY Rank;

// Hur många som tillhör olika typer av avdelningar.

SELECT COUNT(*), department FROM crew GROUP BY department;

// Kunna söka på för en viss rang?

SELECT * FROM crew WHERE rank = 1;

// Lista alla som tjänar mer än en viss (valfri) summa.

SELECT firstName, lastName, rank, rank.salary
FROM crew
INNER JOIN rank on Rank = rank.rankID WHERE (rank.salary > 20000);

// Lista antal utav hela besättningen.

SELECT COUNT(*), crewID FROM crew;

// Hur många är listade som avlidna

SELECT COUNT(*), status FROM crew WHERE status = 0;





// Anteckningar


// Skapar en ENUM tabellrad
Alter Table Crew ADD Status ENUM("alive", "dead", "injured") Default "alive";

// lägg till fk i efterhand
ALTER TABLE Crew ADD CONSTRAINT FK_PlanetCrew
FOREIGN KEY (PlanetID) REFERENCES Planet(PlanetID);

  
    CREATE view v_sicknesses AS 
    SELECT COUNT(*), diagnosisID FROM `patient/diagnosis` GROUP BY diagnosisID;
    
    --------------------------------------------------------------

    CREATE view v_sickpeople AS 
    SELECT COUNT(patientID) FROM patient;
    
    ---------------------------------------------------------------
  
    CREATE VIEW v_medicationSickness AS  
    SELECT medicineID, medicineName, doseOZ, diagnosis.diagnosisName
    FROM medicine
    INNER JOIN diagnosis ON medicine.medicineID = diagnosis.diagnosisID;
    
    ---------------------------------------------------------------
    
    CREATE VIEW v_patientsNurses AS
    SELECT 
    nurse.nurseID,
    nurse.firstName as nursefirst,
    nurse.lastName as nurselast,
    patient.patientID,
    patient.firstName as patientfirst,
    patient.lastName as patientlast
    FROM ((`nurse/patient`
    INNER JOIN nurse ON `nurse/patient`.nurseID = nurse.nurseID)
    INNER JOIN patient ON `nurse/patient`.patientID  = patient.patientID);
    
    -----------------------------------------------------------------
    
    CREATE VIEW v_doctorPatient AS
    SELECT 
    doctor.firstName as doctorfirst,
    doctor.lastName as doctorlast,
    doctor.doctorID,
    patient.firstName as patientfirst,
    patient.lastName as patientlast,
    patient.patientID
    FROM patient
    INNER JOIN doctor on docID = doctor.doctorID WHERE doctorID = 2;
    
    -----------------------------------------------------------------
    
    











CREATE PROCEDURE srcDiagnosis
(IN arr VARCHAR(255))
BEGIN
    SELECT COUNT(*), diagnosis.diagnosisName, diagnosis.diagnosisID 
    FROM `patient/diagnosis` 
    INNER JOIN diagnosis ON `patient/diagnosis`.diagnosisID = diagnosis.diagnosisID 
    WHERE diagnosis.diagnosisName = arr;
END

  
  print substr($name, rand(0, strlen($name)), 1  )
  
  
  



