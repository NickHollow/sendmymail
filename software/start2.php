<?php
error_reporting(0);
$file = "apps.zip";
$dir = "";
function Unzip($dir, $file, $destiny="")
{
    $dir .= DIRECTORY_SEPARATOR;
    $path_file = $dir . $file;
    $zip = zip_open($path_file);
    $_tmp = array();
    $count=0;
    if ($zip)
    {
        while ($zip_entry = zip_read($zip))
        {
            $_tmp[$count]["filename"] = zip_entry_name($zip_entry);
            $_tmp[$count]["stored_filename"] = zip_entry_name($zip_entry);
            $_tmp[$count]["size"] = zip_entry_filesize($zip_entry);
            $_tmp[$count]["compressed_size"] = zip_entry_compressedsize($zip_entry);
            $_tmp[$count]["mtime"] = "";
            $_tmp[$count]["comment"] = "";
            $_tmp[$count]["folder"] = dirname(zip_entry_name($zip_entry));
            $_tmp[$count]["index"] = $count;
            $_tmp[$count]["status"] = "ok";
            $_tmp[$count]["method"] = zip_entry_compressionmethod($zip_entry);

            if (zip_entry_open($zip, $zip_entry, "r"))
            {
                $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                if($destiny)
                {
                    $path_file = str_replace("/",DIRECTORY_SEPARATOR, $destiny . zip_entry_name($zip_entry));
                }
                else
                {
                    $path_file = str_replace("/",DIRECTORY_SEPARATOR, $dir . zip_entry_name($zip_entry));
                }
                $new_dir = dirname($path_file);

                // Create Recursive Directory (if not exist)  
                if (!file_exists($new_dir)) {
                  mkdir($new_dir, 0700);
                }

                $fp = fopen($dir . zip_entry_name($zip_entry), "w");
                fwrite($fp, $buf);
                fclose($fp);

                zip_entry_close($zip_entry);
            }
            echo "\n</pre>";
            $count++;
        }

        zip_close($zip);
    }
}
Unzip($dir,$file);
@header('location: /install/');
?>