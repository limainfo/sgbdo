<?php

set_time_limit(0);

class ftp {

    public $ftp_server;
    public $login_ftp;
    public $pass_ftp;
    public $ftp_dir;
    public $local_dir;
    public $id_ftp;
    private $ftp_port = 21;
    public $ftp_time = 90;
    public $ftp_contents;
    public $login_result;
    public $copy;
    public $extensoes;

    public function __construct() {
        //include_once('config.inc');
        $servidorFTP = "192.168.11.11";
        $loginFTP = 'dms';
        $passFTP = 'dms';
        $ftpDIR = '/local/users/dms/PLN/';

        $localDIR = "/var/www/sgbdo/webroot/estatisticas/";

        $extensoesDOWNLOAD = array(".rel1", ".rel2", ".rel3", ".rel4", ".rel5", ".rel6", ".set", ".atm");

        $this->ftp_server = $servidorFTP;
        $this->login_ftp = $loginFTP;
        $this->pass_ftp = $passFTP;
        $this->ftp_dir = $ftpDIR;
        $this->local_dir = $localDIR;
        $this->extensoes = $extensoesDOWNLOAD;

        $this->id_ftp = ftp_connect($this->ftp_server, $this->ftp_port, $this->ftp_time) or die("Nao conectou ao ftp");

        if ($this->id_ftp) {
            $this->setLogin();
        }
    }

    public function setLogin() {

        $this->login_result = ftp_login($this->id_ftp, $this->login_ftp, $this->pass_ftp);

        if ($this->login_result) {

            $this->getlistFiles();
        }
    }

    public function getlistFiles() {

        $this->ftp_dir = ftp_chdir($this->id_ftp, $this->ftp_dir); //coloque o diretorio de origem dos arquivos

        $this->ftp_contents = ftp_nlist($this->id_ftp, "");

        if ($this->ftp_contents) {

            print_r($this->ftp_contents);

            $this->copyFiles();
        }
    }

    public function copyFiles() {

        if (($this->local_dir != "") and (!is_dir($this->local_dir))) {
            mkdir($this->local_dir, 0777);
        }

        for ($i = 0; $i < count($this->ftp_contents); $i++) {

            $extensao = strrchr($this->ftp_contents[$i], '.');
            if (!in_array($extensao, $this->extensoes))
                continue;

            $this->copy = ftp_nb_get($this->id_ftp, $this->local_dir . $this->ftp_contents[$i], $this->ftp_contents[$i], FTP_BINARY);
            echo $this->ftp_contents[$i] . " - download: ";
            while ($this->copy == FTP_MOREDATA) {
                echo ".";
                $this->copy = ftp_nb_continue($this->id_ftp);
            }

            if ($this->copy == FTP_FINISHED) {
                echo " 100%\n";
                if (ftp_delete($this->id_ftp, '/local/users/dms/PLN/' . $this->ftp_contents[$i])) {
                    echo "O arquivo {$this->ftp_dir}{$this->ftp_contents[$i]} foi excluído\n";
                } else {
                    echo "não foi possível excluir {$this->ftp_dir}/local/users/dms/PLN/{$this->ftp_contents[$i]}\n";
                }
            }

            if ($this->copy != FTP_FINISHED) {
                echo "Ocorreu um erro ao baixar o arquivo " . $this->ftp_contents[$i];
            } else {
                continue;
            }
        }
    }

    public function __destruct() {

        ftp_close($this->id_ftp);
    }

}

$DOWNLOAD = new ftp();
include_once('trataRel.php');
?>