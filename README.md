# FashionReRun Product UploadScript

## Changes Made To Original UploadScript

- Changed original code of procedural php to OOPS.
- Integrated all divided codes to single folder structure program as a quality of life improvement.
- Added env.php for maintaining basic api urls and other user inputs.

## Run this commands:

`mkdir ClothingSheet && mkdir xmlfiles && mkdir xmlfiles/temp && mkdir Downloads && mkdir Image && mkdir logs && mkdir import && mkdir finished`


## Steps to follow:

###### Step 1

- Clone the repo

   Clone the repo from code or download the zip.
  
   Move tocsv.sh to ClothingSheet folder.

###### Step 2

- Provide your project root location in :-

 `config/importer.php`

 also in 

 `autoload.php`

###### Step 3

- Add the root url for Api and password and username in the following location:-

`etc/env.php`

###### Step 4

- Generate Xml Files 
  Generate .xml files for product upload by going into(run xmlGenerator.php) :-

  `xmlGenerator/xmlGenerator.php`

 ###### ***Note***
 make sure there is xmfiles in project root folder and inside temp folder if not there please create those files.


  


###### Step 5 

- Copy your BatchImages (zip) to downloads folder(in batch ex: in morning copy only files for morning upload).
- Copy your xlsm files in ClothingSheet folder(in batch ex: in morning copy only files for morning upload). 

###### Step 6

- Run sort.php to Resize Images from location:-

 `image_optimizer/sort.php`

 verify images for rotation and continue to next step.

###### Step 7

- Run upload Script to upload product to site.

run this file for uploading Products.

`upload.php`


