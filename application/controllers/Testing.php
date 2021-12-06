<?php

class Testing extends CI_Controller
{
    public function index()
    {
        $this->load->view('leaflet/maps');
    }

    public function makeTxtFile()
    {
        $myFile = fopen(APPPATH . "../assets/build/newfile.txt", "w") or die("Unable to open file");
        $txt = "Bagus";
        fwrite($myFile, $txt);
        $txt = "jane Doe";
        fwrite($myFile, $txt);
        fclose($myFile);
    }

    public function bacaTxtFile()
    {
        $file = APPPATH . "../assets/build/newfile.txt";
        // Open the file to get existing content
        $current = file_get_contents($file);
        //New text
        $current = "Tambahan \n" . $current;
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    public function phpInfo()
    {
        echo phpinfo();
    }
}
