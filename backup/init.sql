USE master
GO
DROP DATABASE IF EXISTS wordle
GO
create database wordle
GO
USE wordle
GO
CREATE TABLE RAWPALABRAS (ID INT,PALABRAS VARCHAR(29))
GO 
Bulk Insert RAWPALABRAS From '/var/opt/mssql/backup/PALABRAS.csv'
 With (Fieldterminator = ';' , Rowterminator = '0x0a')
create table palabras(id int IDENTITY(1,1) primary key,palabra varchar(5),fecha DATE)
INSERT INTO PALABRAS 
SELECT PALABRAS,GETDATE() FROM RAWPALABRAS
UPDATE PALABRAS SET FECHA = DATEADD(DAY,ID-1,GETDATE())
DROP TABLE RAWPALABRAS

go
CREATE OR ALTER function DimePalabraDeHoy()
returns varchar(5)
as
begin 
declare @palabra as varchar(5) = (select top 1 palabra from palabras where fecha=cast(getdate() as date))
return @palabra
end
go
