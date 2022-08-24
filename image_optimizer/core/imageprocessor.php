<?php

class ImageProcessor
{
    public $originalImageCount = array();
    public $processingCount = array();
    public $sku;
    public $imagePath;
    public $imageSource;
    public $imageProcessPath;
    public $currentWorkingFolder;
    public $resolution = array();

    public function __construct($source, $destination, $imageProcessPath)
    {

        $this->imagePath = $destination;
        $this->imageSource = $source;
        $this->imageProcessPath = $imageProcessPath;
        $dataFromJson = file_get_contents('./core/resolution.json');
        $dataFromJson = json_decode($dataFromJson, true);
        extract($dataFromJson);
        $this->resolution = $resolution;

    }

    public function extractImage()
    {
        $zip = new ZipArchive;
        $dir = "$this->imageSource/*.zip";
        $files = glob($dir);
        foreach ($files as $file) {

            if ($zip->open($file) === true) {
                // Unzip Path
                $zip->extractTo($this->imagePath);
                $zip->close();
            }

        }
    }

    public function getImageCount()
    {

        return $this->originalImageCount;

    }

    public function optimizeImage()
    {
        $folders = glob($this->imagePath . '/*', GLOB_ONLYDIR);
        foreach ($folders as $folderName) {
            $this->currentWorkingFolder = basename($folderName);
            //## to get image count

            $this->originalImageCount[] = ['folderName' => $this->currentWorkingFolder, 'imageCount' => count(glob("$folderName/*.{jpg,jpeg,JPG}", GLOB_BRACE))];

            $imageFiles = scandir($folderName);
            foreach ($imageFiles as $imageFile) {

                $ext = explode(".", $imageFile);
                if ($ext[1] == 'jpg' || $ext[1] == 'JPG' || $ext[1] == 'jpeg') {

                    //########## for getting image width and size
                    rename($folderName . "/" . $imageFile, $this->imageProcessPath . "/processor/$ext[0].JPG");

                }
            }

            $this->sortAndOptimize();

        }

    }

    public function sortAndOptimize()
    {
        $imageFiles = scandir("$this->imageProcessPath/processor/");
        $this->processingCount[] = ['folderName' => 'processor', 'imageCount' => count(glob("$this->imageProcessPath/processor/*.{jpg,jpeg,JPG}", GLOB_BRACE))];

        foreach ($imageFiles as $imageFile) {
            $ext = explode(".", $imageFile);
            if ($ext[1] == 'JPG') {
//########## for getting image width and size
                $data = getimagesize("$this->imageProcessPath/processor/" . $imageFile);
                $width = $data[0];
                $height = $data[1];
                $search = "$width x $height";

                if (!empty($this->checkImageExists('processor'))) {
                    if (in_array($search, $this->resolution)) {
                        rename("$this->imageProcessPath/processor/" . $imageFile, $this->imageProcessPath . "/rotator/$imageFile");
                    }
                } else {
                    echo "No images were found here!";
                }

            }
        }

        if (!empty($this->checkImageExists('processor'))) {
            $this->compressImage();
        }

        if (!empty($this->checkImageExists('rotator'))) {
            $this->rotateImage();
            $this->moveImagesToSourceFile('rotator');
        }
        $this->moveImagesToSourceFile('processor');

    }

    public function compressImage()
    {
        shell_exec("cd $this->imageProcessPath/processor/ ; sh cmp.sh");

    }
    public function rotateImage()
    {
        shell_exec("cd $this->imageProcessPath/rotator/ ; sh rotate.sh");

    }
    public function moveImagesToSourceFile($source)
    {

        $execute = "mv $this->imageProcessPath/$source/*.JPG $this->imagePath/$this->currentWorkingFolder";
        exec($execute);

    }
    public function checkImageExists($source)
    {
        $files = glob("$this->imageProcessPath/$source/" . "*.{jpg,jpeg,JPG}", GLOB_BRACE);
        return $files;
    }

    public function validator()
    {
        echo $this->imagePath;
    }
}
