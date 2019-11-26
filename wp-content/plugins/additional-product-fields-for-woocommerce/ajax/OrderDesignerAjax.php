<?php


namespace rednaowooextraproduct\ajax;


use rednaowooextraproduct\pr\Managers\FileManager\FileManager;
use rednaowooextraproduct\repository\ProductRepository;

class OrderDesignerAjax extends AjaxBase
{

    public function __construct($core, $prefix)
    {
        parent::__construct($core, $prefix, 'order_designer');
    }


    protected function RegisterHooks()
    {
        $this->RegisterPrivate('getfileupload','GetFileUpload');
        $this->RegisterPublic('dontshowagain','DontShowAgain',false);
    }

    public function DontShowAgain(){
        \update_option('rednaowooextraproduct_dont_show_again',1);
    }

    public function GetFileUpload(){
        if(!isset($_GET['path']))
            $this->SendErrorMessage('Invalid operation');

        if(!isset($_GET['path']))
            $this->SendErrorMessage('Invalid operation');

        $path=basename(\strval($_GET['path']));
        $name=$_GET['name'];

        $manager=new FileManager($this->Loader);

        $baseDir=$manager->GetOrderFolderRootPath();


        $realPath=$baseDir.$path;

        if(!\file_exists($realPath))
        {
            $this->SendErrorMessage('File does not exists');
        }


        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Disposition: attachment; filename="'.$name.'"');


        //Define file size
        header('Content-Length: ' . filesize($realPath));
        readfile($realPath);
        exit;



    }
}