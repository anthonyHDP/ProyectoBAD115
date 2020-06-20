<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->integer('codigo_municipio',4);
            $table->char('codigo_departamento',5)->unsigned();
            $table->string('nombre',26);
            $table->primary('codigo_municipio');

            $table->foreign('codigo_departamento')->references('codigo_departamento')->on('departamentos');
        });
            //Zona Occidental
            //Santa Ana
            DB::table('municipios')->insert(array('codigo_municipio'=>'0201','codigo_departamento'=>'2201','nombre'=>'Candelaria de la Frontera'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0202','codigo_departamento'=>'2201','nombre'=>'Coatepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0203','codigo_departamento'=>'2201','nombre'=>'Chalchuapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0204','codigo_departamento'=>'2201','nombre'=>'El Congo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0205','codigo_departamento'=>'2201','nombre'=>'El Porvenir'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0206','codigo_departamento'=>'2201','nombre'=>'Masahuat'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0207','codigo_departamento'=>'2201','nombre'=>'Metapan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0208','codigo_departamento'=>'2201','nombre'=>'San Antonio Pajonal'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0209','codigo_departamento'=>'2201','nombre'=>'San Sebastian Salitrillo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0210','codigo_departamento'=>'2201','nombre'=>'Santa Ana'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0211','codigo_departamento'=>'2201','nombre'=>'Santa Rosa Guachipilin'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0212','codigo_departamento'=>'2201','nombre'=>'Santiago de la Frontera'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0213','codigo_departamento'=>'2201','nombre'=>'Texistepeque'));
        
            //Ahuachapan
            DB::table('municipios')->insert(array('codigo_municipio'=>'0101','codigo_departamento'=>'2101','nombre'=>'Ahuachapan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0102','codigo_departamento'=>'2101','nombre'=>'Apaneca'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0103','codigo_departamento'=>'2101','nombre'=>'Atiquizaya'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0104','codigo_departamento'=>'2101','nombre'=>'Concepcion de Ataco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0105','codigo_departamento'=>'2101','nombre'=>'El Refugio'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0106','codigo_departamento'=>'2101','nombre'=>'Guaymango'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0107','codigo_departamento'=>'2101','nombre'=>'Jujutla'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0108','codigo_departamento'=>'2101','nombre'=>'San Francisco Menendez'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0110','codigo_departamento'=>'2101','nombre'=>'San Pedro Puxtla'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0111','codigo_departamento'=>'2101','nombre'=>'Tacuba'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0112','codigo_departamento'=>'2101','nombre'=>'Turin'));
            
            //Sonsonate
            DB::table('municipios')->insert(array('codigo_municipio'=>'0301','codigo_departamento'=>'2301','nombre'=>'Acajutla'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0302','codigo_departamento'=>'2301','nombre'=>'Armenia'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0303','codigo_departamento'=>'2301','nombre'=>'Caluco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0304','codigo_departamento'=>'2301','nombre'=>'Cuisnahuat'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0305','codigo_departamento'=>'2301','nombre'=>'Santa Isabel Ishuatán'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0306','codigo_departamento'=>'2301','nombre'=>'Izalco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0307','codigo_departamento'=>'2301','nombre'=>'Juayua'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0308','codigo_departamento'=>'2301','nombre'=>'Nahuizalco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0309','codigo_departamento'=>'2301','nombre'=>'Nahuilingo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0310','codigo_departamento'=>'2301','nombre'=>'Salcoatitan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0311','codigo_departamento'=>'2301','nombre'=>'San Antonio del Monte'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0312','codigo_departamento'=>'2301','nombre'=>'San Julian'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0313','codigo_departamento'=>'2301','nombre'=>'Santa Catarina Masahuat'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0314','codigo_departamento'=>'2301','nombre'=>'Santo Domingo Guzmán'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0315','codigo_departamento'=>'2301','nombre'=>'Sonsonate'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0316','codigo_departamento'=>'2301','nombre'=>'Sonzacate'));
            
            //Zona Central
            //La Libertad
            DB::table('municipios')->insert(array('codigo_municipio'=>'0501','codigo_departamento'=>'1501','nombre'=>'Antiguo Cuscatlan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0502','codigo_departamento'=>'1501','nombre'=>'Ciudad Arce'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0503','codigo_departamento'=>'1501','nombre'=>'Colon'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0504','codigo_departamento'=>'1501','nombre'=>'Comasagua'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0505','codigo_departamento'=>'1501','nombre'=>'Chiltiupan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0506','codigo_departamento'=>'1501','nombre'=>'Huizucar'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0507','codigo_departamento'=>'1501','nombre'=>'Jayaque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0508','codigo_departamento'=>'1501','nombre'=>'Jicalapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0509','codigo_departamento'=>'1501','nombre'=>'La Libertad'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0510','codigo_departamento'=>'1501','nombre'=>'Nuevo Cuscatlan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0511','codigo_departamento'=>'1501','nombre'=>'Santa Tecla'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0512','codigo_departamento'=>'1501','nombre'=>'Quezaltepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0513','codigo_departamento'=>'1501','nombre'=>'Sacacoyo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0514','codigo_departamento'=>'1501','nombre'=>'San Jose Villanueva'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0515','codigo_departamento'=>'1501','nombre'=>'San Juan Opico'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0516','codigo_departamento'=>'1501','nombre'=>'San Matias'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0517','codigo_departamento'=>'1501','nombre'=>'San Pablo Tacachico'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0518','codigo_departamento'=>'1501','nombre'=>'Tamanique'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0519','codigo_departamento'=>'1501','nombre'=>'Talnique'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0520','codigo_departamento'=>'1501','nombre'=>'Teotepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0521','codigo_departamento'=>'1501','nombre'=>'Tepecoyo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0522','codigo_departamento'=>'1501','nombre'=>'Zaragoza'));   
            
             //Chalatenango
            DB::table('municipios')->insert(array('codigo_municipio'=>'0401','codigo_departamento'=>'1301','nombre'=>'Agua Caliente'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0402','codigo_departamento'=>'1301','nombre'=>'Arcatao'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0403','codigo_departamento'=>'1301','nombre'=>'Azacualpa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0404','codigo_departamento'=>'1301','nombre'=>'Citala'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0405','codigo_departamento'=>'1301','nombre'=>'Comalapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0406','codigo_departamento'=>'1301','nombre'=>'Concepción Quezaltepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0407','codigo_departamento'=>'1301','nombre'=>'Chalatenango'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0408','codigo_departamento'=>'1301','nombre'=>'Dulce Nombre de María'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0409','codigo_departamento'=>'1301','nombre'=>'El Carrizal'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0410','codigo_departamento'=>'1301','nombre'=>'El Paraiso'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0411','codigo_departamento'=>'1301','nombre'=>'La Laguna'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0412','codigo_departamento'=>'1301','nombre'=>'La Palma'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0413','codigo_departamento'=>'1301','nombre'=>'La Reina'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0414','codigo_departamento'=>'1301','nombre'=>'Las Vueltas'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0415','codigo_departamento'=>'1301','nombre'=>'Nombre de Jesus'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0416','codigo_departamento'=>'1301','nombre'=>'Nueva Concepcion'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0417','codigo_departamento'=>'1301','nombre'=>'Nueva Trinidad'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0418','codigo_departamento'=>'1301','nombre'=>'Ojos de Agua'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0419','codigo_departamento'=>'1301','nombre'=>'Potonico'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0420','codigo_departamento'=>'1301','nombre'=>'San Antonio de la Cruz'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0421','codigo_departamento'=>'1301','nombre'=>'San Antonio Los Ranchos'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0422','codigo_departamento'=>'1301','nombre'=>'San Fernando'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0423','codigo_departamento'=>'1301','nombre'=>'San Francisco Lempa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0424','codigo_departamento'=>'1301','nombre'=>'San Francisco Morazan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0425','codigo_departamento'=>'1301','nombre'=>'San Ignacio'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0426','codigo_departamento'=>'1301','nombre'=>'San Isidro Labrador'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0427','codigo_departamento'=>'1301','nombre'=>'San Jose Cancasque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0428','codigo_departamento'=>'1301','nombre'=>'San Jose Las Flores'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0429','codigo_departamento'=>'1301','nombre'=>'San Luis del Carmen'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0430','codigo_departamento'=>'1301','nombre'=>'San Miguel de Mercedes'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0431','codigo_departamento'=>'1301','nombre'=>'San Rafael'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0432','codigo_departamento'=>'1301','nombre'=>'Santa Rita'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0433','codigo_departamento'=>'1301','nombre'=>'Tejutla'));
           
          //San Salvador
            DB::table('municipios')->insert(array('codigo_municipio'=>'0601','codigo_departamento'=>'1101','nombre'=>'Aguilares'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0602','codigo_departamento'=>'1101','nombre'=>'Apopa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0603','codigo_departamento'=>'1101','nombre'=>'Ayutuxtepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0604','codigo_departamento'=>'1101','nombre'=>'Cuscatancingo'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0605','codigo_departamento'=>'1101','nombre'=>'El Paisnal'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0606','codigo_departamento'=>'1101','nombre'=>'Guazapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0607','codigo_departamento'=>'1101','nombre'=>'Ilopango'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0608','codigo_departamento'=>'1101','nombre'=>'Mejicanos'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0609','codigo_departamento'=>'1101','nombre'=>'Nejapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0610','codigo_departamento'=>'1101','nombre'=>'Panchimalco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0611','codigo_departamento'=>'1101','nombre'=>'Rosario de Mora'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0612','codigo_departamento'=>'1101','nombre'=>'San Marcos'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0613','codigo_departamento'=>'1101','nombre'=>'San Martin'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0614','codigo_departamento'=>'1101','nombre'=>'San Salvador'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0615','codigo_departamento'=>'1101','nombre'=>'Santiago Texacuangos'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0616','codigo_departamento'=>'1101','nombre'=>'Santo Tomas'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0617','codigo_departamento'=>'1101','nombre'=>'Soyapango'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0618','codigo_departamento'=>'1101','nombre'=>'Tonacatepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0619','codigo_departamento'=>'1101','nombre'=>'Ciudad Delgado'));
            
            //Cuscatlan
            DB::table('municipios')->insert(array('codigo_municipio'=>'0701','codigo_departamento'=>'1401','nombre'=>'Candelaria'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0702','codigo_departamento'=>'1401','nombre'=>'Cojutepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0703','codigo_departamento'=>'1401','nombre'=>'El Carmen'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0704','codigo_departamento'=>'1401','nombre'=>'El Rosario'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0705','codigo_departamento'=>'1401','nombre'=>'Monte San Juan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0706','codigo_departamento'=>'1401','nombre'=>'Oratorio de Concepcion'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0707','codigo_departamento'=>'1401','nombre'=>'San Bartolome Perulapia'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0708','codigo_departamento'=>'1401','nombre'=>'San Cristobal'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0709','codigo_departamento'=>'1401','nombre'=>'San Jose Guayabal'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0710','codigo_departamento'=>'1401','nombre'=>'San Pedro Perulapan'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0711','codigo_departamento'=>'1401','nombre'=>'San Rafael Cedros'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0712','codigo_departamento'=>'1401','nombre'=>'San Ramon'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0713','codigo_departamento'=>'1401','nombre'=>'Santa Cruz Analquito'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0714','codigo_departamento'=>'1401','nombre'=>'Santa Cruz Michapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0715','codigo_departamento'=>'1401','nombre'=>'Suchitoto'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0716','codigo_departamento'=>'1401','nombre'=>'Tenancingo'));

            //Cabañas
            DB::table('municipios')->insert(array('codigo_municipio'=>'0901','codigo_departamento'=>'1201','nombre'=>'Cinquera'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0902','codigo_departamento'=>'1201','nombre'=>'Guacotecti'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0903','codigo_departamento'=>'1201','nombre'=>'Ilobasco'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0904','codigo_departamento'=>'1201','nombre'=>'Jutiapa'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0905','codigo_departamento'=>'1201','nombre'=>'San Isidro'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0906','codigo_departamento'=>'1201','nombre'=>'Sensuntepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0907','codigo_departamento'=>'1201','nombre'=>'Tejutepeque'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0908','codigo_departamento'=>'1201','nombre'=>'Victoria'));
            DB::table('municipios')->insert(array('codigo_municipio'=>'0909','codigo_departamento'=>'1201','nombre'=>'Dolores'));
            
            //La Paz



            //Zona Oriental
            //Usulutan
            //San Miguel
            //Morazan
            //La Union

    }       




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
