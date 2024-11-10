<?php
$jumlah     = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
/*---------------------------------------------------------------*/
$pembilang  = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$penyebut   = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
// indeks 0 = suami
// indeks 1 = istri
// indeks 2 = ayah
// indeks 3 = ibu
// indeks 4 = anak laki-laki
// indeks 5 = anak perempuan
// indeks 6 = cucu laki-laki
// indeks 7 = cucu perempuan dari anak laki-laki
// indeks 8 = saudara sekandung
// indeks 9 = saudara seayah
// indeks 10 = saudara seibu
// indeks 11 = saudari sekandung
// indeks 12 = saudari seayah
// indeks 13 = saudari seibu
// indeks 14 = kakek
// indeks 15 = nenek
$ahliwaris =    ['Suami','Istri','Ayah','Ibu','Anak Laki-laki','Anak Perempuan','Cucu Laki-laki',
                'Cucu Perempuan dari anak Laki-laki','Saudara Sekandung','Saudara Seayah','Saudara Seibu',
                'Saudari Sekandung','Saudari Seayah','Saudari Seibu','Kakek','Nenek'];
$pembilangtotal = 0;
$asalmasalah = 1;
$ashobah = false;
$P_ashobah = 0;
$gharawain1 = false;
$gharawain2 = false;
$harta = 0;
$harta2 = 0;
$hutang = 0;
$biayajenazah = 0;
$kosong = true;

function pembagian() {
    global $jumlah; 
    global $pembilang; 
    global $penyebut;
    //suami 
    if ($jumlah[0]>0) {
        if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0) {
            $pembilang[0]   = 1;
            $penyebut[0]    = 2;
        } else if ($jumlah[4]>0 || $jumlah[5]>0 || $jumlah[6]>0 || $jumlah[7]>0) {
            $pembilang[0]   = 1;
            $penyebut[0]    = 4;
        }
    }
    //istri
    if ($jumlah[1]>0) {
        if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0) {
            $pembilang[1]   = 1;
            $penyebut[1]    = 4;
        } else if ($jumlah[4]>0 || $jumlah[5]>0 || $jumlah[6]>0 || $jumlah[7]>0) {
            $pembilang[1]   = 1;
            $penyebut[1]    = 8;
        }
    }
    //ayah
    if ($jumlah[2]>0) {
        if ($jumlah[5]>0 || $jumlah[7]>0) {
            $pembilang[2]   = 1;
            $penyebut[2]    = -1;   
        } else if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0) {
            $pembilang[2]   = 1;
            $penyebut[2]    = -1;      
        } else if ($jumlah[4]>0 || $jumlah[6]>0) {
            $pembilang[2]   = 1;
            $penyebut[2]    = 6;
        }
    }
    //ibu
    if ($jumlah[3]>0) {
        if ($jumlah[4]>0 || $jumlah[5]>0 || $jumlah[6]>0 || $jumlah[7]>0 || $jumlah[8]>1 || $jumlah[11]>1) {
            $pembilang[3]   = 1;
            $penyebut[3]    = 6;            
        } else if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0) {
            $pembilang [3]  = 1;
            $penyebut[3]    = 3;  
        } 
    }
    //putra
    if ($jumlah[4]>0) {
        $pembilang[4]   = 1;
        $penyebut[4]    = -1;
    }
    //putri
    if ($jumlah[5]>0) {
        if ($jumlah[4]>0) {
        $pembilang[5]   = 1;
        $penyebut[5]    = -1;            
        } else if ($jumlah[5]==1 && $jumlah[4]==0) {
        $pembilang[5]   = 1;
        $penyebut[5]    = 2;            
        } else if ($jumlah[5]>1 && $jumlah[4]==0) {
        $pembilang[5]   = 2;
        $penyebut[5]    = 3;            
        }
    }
    //cucu laki-laki
    if ($jumlah[6]>0 && $jumlah[4]==0) {
        $pembilang[6]   = 1;
        $penyebut[6]    = -1; 
    }
    //cucu perempuan dari putra
    if ($jumlah[7]>0) {
        if ($jumlah[6]==1 && $jumlah[4]==0 && $jumlah[5]<1){
        $pembilang[6]   = 1;
        $penyebut[6]    = -1;           
        } else if ($jumlah[5]==1 && $jumlah[4]==0 && $jumlah[6]==0) {
        $pembilang[7]   = 1;
        $penyebut[7]    = 6;
        } else if ($jumlah[7]==1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[5]<1) {
        $pembilang[7]   = 1;
        $penyebut[7]    = 2; 
        } else if ($jumlah[7]>1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[5]<1) {
        $pembilang[7]   = 2;
        $penyebut[7]    = 3;
        }
    }
    //saudara kandung
    if ($jumlah[8]>0 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[8]   = 1;
        $penyebut[8]    = -1;        
    }
    //saudara seayah
    if ($jumlah[9]>0 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0) {
        $pembilang[9]   = 1;
        $penyebut[9]    = -1;          
    }
    //saudara seibu
    if ($jumlah[10]>0) {
        if ($jumlah[10]==1 && $jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[10]   = 1;
        $penyebut[10]    = 6;            
        } else if ($jumlah[10]>1 && $jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[10]   = 1;
        $penyebut[10]    = 3;   
        }
    }
    //saudari kandung
    if ($jumlah[11]>0) {
        if (($jumlah[5]>0 || $jumlah[7]>0 || $jumlah[8]>0) && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[11]   = 1;
        $penyebut[11]    = -1;             
        } else if ($jumlah[11]==1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0) {
        $pembilang[11]   = 1;
        $penyebut[11]    = 2;               
        } else if ($jumlah[11]>1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0) {
        $pembilang[11]   = 2;
        $penyebut[11]    = 3;             
        }
    }
    //saudari seayah
    if ($jumlah[12]>0) {
        if (($jumlah[5]>0 || $jumlah[7]>0 || $jumlah[9]>0) && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0) {
        $pembilang[12]   = 1;
        $penyebut[12]    = -1;             
        } else if ($jumlah[11]>1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0 && $jumlah[9]==0) {
        $pembilang[12]   = 1;
        $penyebut[12]    = 6;          
        } else if ($jumlah[12]==1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0 && $jumlah[9]==0) {
        $pembilang[12]   = 1;
        $penyebut[12]    = 2;              
        } else if ($jumlah[12]>1 && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $jumlah[14]==0 && $jumlah[8]==0 && $jumlah[9]==0) {
        $pembilang[12]   = 2;
        $penyebut[12]    = 3;              
        }
    }
    //saudari seibu
    if ($jumlah[13]>0) {
        if ($jumlah[13]==1 && $jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[13]   = 1;
        $penyebut[13]    = 6;            
        } else if ($jumlah[13]>1 && $jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0 && $jumlah[2]==0 && $jumlah[14]==0) {
        $pembilang[13]   = 1;
        $penyebut[13]    = 3;   
        }
    }
    //kakek
    if ($jumlah[14]>0) {
        if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0 && $jumlah[2]==0) {
        $pembilang[14]   = 1;
        $penyebut[14]    = -1;        
        } else if (($jumlah[5]>0 && $jumlah[7]>0) && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0) {
        $pembilang[14]   = 1;
        $penyebut[14]    = -1;            
        } else if (($jumlah[4]>0 || $jumlah[6]>0) && $jumlah[2]==0) {
        $pembilang[14]   = 1;
        $penyebut[14]    = 6;             
        }
    }
    //nenek
    if ($jumlah[15]>0 && $jumlah[3]==0) {
        $pembilang[15]   = 1;
        $penyebut[15]    = 6; 
    }
}

function fpb($a, $b) {
    if ($b == 0)
    return $a;
    return fpb($b, $a % $b);
}

function hasil() {
    global $jumlah; 
    global $pembilang; 
    global $penyebut;
    global $asalmasalah;
    global $harta;
    global $harta2;
    global $pembilangtotal;
    global $ashobah;
    global $P_ashobah;
    global $gharawain1;
    global $gharawain2;
    global $ahliwaris;
    global $kosong;
    $harta2 =$harta;
    for ($i = 0; $i < 16; $i++) {
    if ($penyebut[$i]>0) {
        $asalmasalah = ((($penyebut[$i] * $asalmasalah)) / (fpb($penyebut[$i], $asalmasalah)));
    }
    }
    for ($i = 0; $i < 16; $i++) {
        if ($pembilang[$i]>0 && $penyebut[$i]>0) {
            $pembilang[$i] = $pembilang[$i] * ($asalmasalah / $penyebut[$i]);
            $pembilangtotal += $pembilang[$i];
        }
    }
    if ($jumlah[1]==1 && $jumlah[0]==0 && $jumlah[2]==1 && $jumlah[3]==1) {
            if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0
                && $jumlah[8]==0 && $jumlah[9]==0 && $jumlah[10]==0 && $jumlah[11]==0
                && $jumlah[12]==0 && $jumlah[13]==0 && $jumlah[14]==0 && $jumlah[15]==0) {
                $gharawain2=true;
            }
    } else if ($jumlah[0]==1 && $jumlah[2]==1 && $jumlah[3]==1 && $jumlah[1]==0) {
            if ($jumlah[4]==0 && $jumlah[5]==0 && $jumlah[6]==0 && $jumlah[7]==0
                && $jumlah[8]==0 && $jumlah[9]==0 && $jumlah[10]==0 && $jumlah[11]==0
                && $jumlah[12]==0 && $jumlah[13]==0 && $jumlah[14]==0 && $jumlah[15]==0) {
                $gharawain1=true;
            }
    }
    if ($penyebut[4]==-1 && $penyebut[5]==-1) {
        $pembilang[4]=2;
        $pembilang[5]=1;
    }
    if ($penyebut[6]==-1 && $penyebut[7]==-1) {
        $pembilang[6]=2;
        $pembilang[7]=1;
    }
    if ($penyebut[8]==-1 && $penyebut[11]==-1) {
        $pembilang[8]=2;
        $pembilang[11]=1;
    }
    if ($penyebut[9]==-1 && $penyebut[12]==-1) {
        $pembilang[9]=2;
        $pembilang[12]=1;
    }
    for ($i = 0; $i < 16; $i++) {
        if ($penyebut[$i]==-1) {
            $pembilang[$i] = $pembilang[$i]*$jumlah[$i];
        }
    }  
    for ($i = 0; $i < 16; $i++) {
        if ($penyebut[$i]==-1) {
            $ashobah=true;
            $P_ashobah = $P_ashobah+$pembilang[$i];
        }
    }
    for ($i = 0; $i < 16; $i++) {
        if ($jumlah[$i]!=0) {
            $kosong = false;
            break;
        }        
    }
    if ($kosong==true) {
        echo "Input tidak boleh kosong!";
        echo "<br>";
    }
    if ($gharawain1==false && $gharawain2==false && $kosong==false) {
    echo "Total Pembilang: " . $pembilangtotal;
    echo "<br>";
    echo "Asal masalah: " . $asalmasalah;
    echo "<br>"; 
    for ($i = 0; $i < 16; $i++) {
        if ($penyebut[$i]==-1) {
            echo "Sisa Pembilang: " . ($asalmasalah - $pembilangtotal) . " (Untuk penerima Ashobah)";
            echo "<br>";
            break;
        }        
    }
    echo "---------------------------------------------------------------------------------------------------------------";
    echo "<br>";         
    }
    if ($pembilangtotal < $asalmasalah && $ashobah==false && $kosong==false) {
        $asalmasalah = $pembilangtotal;
        echo "Di Radkan menjadi: " . $pembilangtotal . "/" . $asalmasalah;
        echo "<br>";
    } else if ($pembilangtotal > $asalmasalah && $ashobah==false && $kosong==false) {
        $asalmasalah = $pembilangtotal;
        echo "Di Aulkan menjadi: " . $asalmasalah;
        echo "<br>";
    }
    for ($i = 0; $i < 16; $i++) {
        if ($penyebut[$i]>0 && $gharawain1==false && $gharawain2==false) {
            $harta2 -= (($pembilang[$i] * $harta) / $asalmasalah); 
            echo "Rp. " . number_format(($pembilang[$i] * $harta) / $asalmasalah) . " Untuk ". $jumlah[$i] . " " . $ahliwaris[$i] . " (" . $pembilang[$i]. "/" . $asalmasalah . ")"; 
            echo "<br>";
        }
    }   
    for ($i = 0; $i < 16; $i++) {
        if ($penyebut[$i]==-1 && $gharawain1==false && $gharawain2==false) {
            if (($jumlah[5]>0 && $jumlah[7]>0) && $jumlah[4]==0 && $jumlah[6]==0 && $jumlah[2]==0 && $i==14 && $jumlah[14]>0) {
                $harta2 -= ($harta*$jumlah[$i])/6;
                echo "Rp. " . number_format(($harta*$jumlah[$i])/6 + ($harta2 * $pembilang[$i]) / $P_ashobah) . " Untuk ". $jumlah[$i] . " " . $ahliwaris[$i] . " (1/6 dan Ashobah)";
                echo "<br>";                  
            } else if (($jumlah[5]>0 || $jumlah[7]>0) && $i==2 && $jumlah[2]>0) {
                $harta2 -= ($harta*$jumlah[$i])/6;                
                echo "Rp. " . number_format(($harta*$jumlah[$i])/6 + ($harta2 * $pembilang[$i]) / $P_ashobah) . " Untuk ". $jumlah[$i] . " " . $ahliwaris[$i] . " (1/6 dan Ashobah)";
                echo "<br>";                 
            } else {
                echo "Rp. " . number_format(($harta2 * $pembilang[$i]) / $P_ashobah) . " Untuk ". $jumlah[$i] . " " . $ahliwaris[$i] . " (Ashobah)"; 
                echo "<br>";                
            }
        }
    }
    if ($gharawain1==true || $gharawain2==true) {
        echo "Terjadi Gharawain";
        echo "<br>";
        if ($jumlah[0]==1) {
            echo "Rp. " . number_format($harta / 2) . " Untuk " . $jumlah[0] . " " . $ahliwaris[0];
            echo "<br>";
            echo "Rp. " . number_format($harta / 6) . " Untuk " . $jumlah[3] . " " . $ahliwaris[3];
            echo "<br>";
            echo "Rp. " . number_format(($harta * 2) / 6) . " Untuk " . $jumlah[2] . " " . $ahliwaris[2];
        } else if ($jumlah[1]==1) {
            echo "Rp. " . number_format($harta / 4) . " Untuk " . $jumlah[1] . " " . $ahliwaris[1];
            echo "<br>";
            echo "Rp. " . number_format($harta / 12) . " Untuk " . $jumlah[3] . " " . $ahliwaris[3];
            echo "<br>";
            echo "Rp. " . number_format(($harta * 8) / 12) . " Untuk " . $jumlah[2] . " " . $ahliwaris[2];
        }
    }
}

function re_set(){
    $jumlah     = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    /*---------------------------------------------------------------*/
    $pembilang  = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $penyebut   = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $pembilangtotal = 0;
    $asalmasalah = 1;
    $ashobah = false;
    $P_ashobah = 0;
    $gharawain1 = false;
    $gharawain2 = false;
    $harta = 0;
    $harta2 = 0;
    $hutang = 0;
    $biayajenazah = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Alat penghitung warisan secara online" />
    <title>WARIS CALCULATOR ONLINE</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shorcut icon" href="assets/img/Logo.png" />

</head>

<body>
    <div class="form">
        <!--Title dan Logo-->
        <div class="atas" style="display: flex; overflow:hidden; align-items: center">
            <h1>
                Kalkulator
                <span class="warisan"> Warisan</span>
            </h1>
            <div class="atas1" style="margin-left: auto; margin-right: 0">
                <img style="width: 65px" src="assets/img/Logo.png" alt="logo" />
            </div>
        </div>
        <!--Title dan Logo-->
        <hr />
        <!--container-->
        <div class="cont">
            <form action="index.php" method="POST">
                <!--Jumlah Harta-->
                <div>
                    <label class="case">Harta Warisan</label>
                    <input type="number" placeholder="Masukkan jumlah harta" id="rupiah" name="harta"
                        value="<?php echo isset($_POST["harta"]) ? htmlspecialchars($_POST["harta"], ENT_QUOTES) : ''; ?>"
                        required />
                </div>
                <!--Hutang-->
                <div style="padding: 10px 0 0">
                    <label class="case">Hutang</label>
                    <input type="number" placeholder="Masukkan jumlah hutang" id="rupiah" name="hutang"
                        value="<?php echo isset($_POST["hutang"]) ? htmlspecialchars($_POST["hutang"], ENT_QUOTES) : ''; ?>" />
                </div>
                <!--Biaya Jenazah-->
                <div style="padding: 10px 0 0">
                    <label class="case">Biaya Jenazah</label>
                    <input type="number" placeholder="Masukkan biaya jenazah" id="rupiah" name="biayajenazah"
                        value="<?php echo isset($_POST["biayajenazah"]) ? htmlspecialchars($_POST["biayajenazah"], ENT_QUOTES) : ''; ?>" />
                </div>
                <!--suami & istri-->
                <div class="row">
                    <div class="col">
                        <label>Suami</label>
                        <input type="number" placeholder="Jumlah" name="suami" />
                    </div>
                    <div class="col">
                        <label>Istri</label>
                        <input type="number" placeholder="Jumlah" name="istri" />
                    </div>
                </div>
                <!--ayah & ibu-->
                <div class="row">
                    <div class="col">
                        <label>ayah</label>
                        <input type="number" placeholder="Jumlah" name="ayah" />
                    </div>
                    <div class="col">
                        <label>ibu</label>
                        <input type="number" placeholder="Jumlah" name="ibu" />
                    </div>
                </div>
                <!--anaklaki & anakpr-->
                <div class="row">
                    <div class="col">
                        <label>putra</label>
                        <input type="number" placeholder="Jumlah" name="anaklaki" />
                    </div>
                    <div class="col">
                        <label>putri</label>
                        <input type="number" placeholder="Jumlah" name="anakpr" />
                    </div>
                </div>
                <!--cuculaki & cucuprdarilaki-->
                <div class="row">
                    <div class="col">
                        <label><br>cucu laki-laki</label>
                        <input type="number" placeholder="Jumlah" name="cuculaki" />
                    </div>
                    <div class="col">
                        <label>cucu perempuan <br> dari putra</label>
                        <input type="number" placeholder="Jumlah" name="cucuprdarilaki" />
                    </div>
                </div>
                <!--saung & sayah-->
                <div class="row">
                    <div class="col">
                        <label>saudara kandung</label>
                        <input type="number" placeholder="Jumlah" name="saung" />
                    </div>
                    <div class="col">
                        <label>saudara seayah</label>
                        <input type="number" placeholder="Jumlah" name="sayah" />
                    </div>
                </div>
                <!--saibu & siung-->
                <div class="row">
                    <div class="col">
                        <label>saudara seibu</label>
                        <input type="number" placeholder="Jumlah" name="saibu" />
                    </div>
                    <div class="col">
                        <label>saudari kandung</label>
                        <input type="number" placeholder="Jumlah" name="siung" />
                    </div>
                </div>
                <!--siyah & siibu-->
                <div class="row">
                    <div class="col">
                        <label>saudari seayah</label>
                        <input type="number" placeholder="Jumlah" name="siyah" />
                    </div>
                    <div class="col">
                        <label>saudari seibu</label>
                        <input type="number" placeholder="Jumlah" name="siibu" />
                    </div>
                </div>
                <!--kakek & nenek-->
                <div class="row">
                    <div class="col">
                        <label>kakek</label>
                        <input type="number" placeholder="Jumlah" name="kakek" />
                    </div>
                    <div class="col">
                        <label>nenek</label>
                        <input type="number" placeholder="Jumlah" name="nenek" />
                    </div>
                </div>
                <!--buttons-->
                <div class="center">
                    <button name="button1">Hitung</button>
                </div>
                <!--buttons-->
            </form>
        </div>
        <!--container-->
        <div>
            <?php
            if (isset($_POST["hutang"])) {
                $hutang = (int) $_POST["hutang"];
            }
            if (isset($_POST["biayajenazah"])) {
                $biayajenazah = (int) $_POST["biayajenazah"];
            }
            if (isset($_POST["suami"])) {
            $jumlah[0] = (int) $_POST["suami"];
            }
            if (isset($_POST["istri"])) {
            $jumlah[1] = (int) $_POST["istri"];
            }
            if (isset($_POST["ayah"])) {
            $jumlah[2] = (int) $_POST["ayah"];
            }
            if (isset($_POST["ibu"])) {
            $jumlah[3] = (int) $_POST["ibu"];
            }
            if (isset($_POST["anaklaki"])) {
            $jumlah[4] = (int) $_POST["anaklaki"];
            }
            if (isset($_POST["anakpr"])) {
            $jumlah[5] = (int) $_POST["anakpr"];
            }
            if (isset($_POST["cuculaki"])) {
            $jumlah[6] = (int) $_POST["cuculaki"];
            }
            if (isset($_POST["cucuprdarilaki"])) {
            $jumlah[7] = (int) $_POST["cucuprdarilaki"];
            }
            if (isset($_POST["saung"])) {
            $jumlah[8] = (int) $_POST["saung"];
            }
            if (isset($_POST["sayah"])) {
            $jumlah[9] = (int) $_POST["sayah"];
            }
            if (isset($_POST["saibu"])) {
            $jumlah[10] = (int) $_POST["saibu"];
            }
            if (isset($_POST["siung"])) {
            $jumlah[11] = (int) $_POST["siung"];
            }
            if (isset($_POST["siyah"])) {
            $jumlah[12] = (int) $_POST["siyah"];
            }
            if (isset($_POST["siibu"])) {
            $jumlah[13] = (int) $_POST["siibu"];
            }
            if (isset($_POST["kakek"])) {
            $jumlah[14] = (int) $_POST["kakek"];
            }
            if (isset($_POST["nenek"])) {
            $jumlah[15] = (int) $_POST["nenek"];
            }
            if (isset($_POST["harta"])) {
                $harta = (int) $_POST["harta"] - $hutang - $biayajenazah;
            }
            ?>
            <?php
            if(array_key_exists('button1', $_POST)) {
                pembagian();
                hasil();
                re_set();
            }
            ?>
        </div>
        <div style="display: flex; justify-content: center;  padding-top: 48px;">
            <p style="color: gray; font-size: 12px">
                Made with tears and love by Mizan
            </p>
        </div>
    </div>
</body>

</html>
