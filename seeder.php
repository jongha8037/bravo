class FashionBrandsTableAddSeeder extends Seeder {

	public function run() {
	
	//	DB::table('fashion_brands')->delete();
	//	DB::table('fashion_brands')->truncate();

		Eloquent::unguard();

		FashionBrand::create(array('name_en'=>'JACK & JILL','slug'=>'Jack-and-jill','url'=>'http://www.jackandjill.co.kr'));
		FashionBrand::create(array('name_en'=>'BUFFALO','slug'=>'buffalo','url'=>'http://buffalo.co.kr'));
		FashionBrand::create(array('name_en'=>'FOSSIL','slug'=>'fossil','url'=>'http://www.fossil.co.kr'));
		FashionBrand::create(array('name_en'=>'THE STORI','slug'=>'The-stori','url'=>'http://www.thestori.com'));
		FashionBrand::create(array('name_en'=>'NUOVO','slug'=>'nuovo','url'=>'http://www.nuovo.co.kr/'));
		FashionBrand::create(array('name_en'=>'THE HUNDREDS','slug'=>'The-hundreds','url'=>'http://thehundreds.com'));
		FashionBrand::create(array('name_en'=>'THE ROW','slug'=>'The-row','url'=>'http://www.therow.com'));
		FashionBrand::create(array('name_en'=>'ECCO','slug'=>'ecco','url'=>'http://global.ecco.com'));
		FashionBrand::create(array('name_en'=>'WAREHOUSE','slug'=>'warehouse','url'=>'http://www.warehouse.co.uk'));
		FashionBrand::create(array('name_en'=>'ROCKFISH','slug'=>'rockfish','url'=>'http://erockfish.com/main'));
		FashionBrand::create(array('name_en'=>'SE7EN JEANS','slug'=>'Se7en-jeans','url'=>'http://www.7forallmankind.com'));
		FashionBrand::create(array('name_en'=>'MAERYO','slug'=>'maeryo','url'=>'http://www.maeryo.co.kr'));
		FashionBrand::create(array('name_en'=>'BOUNTYXHUNTER','slug'=>'bountyxhunter','url'=>'http://www.bounty-hunter.com'));
		FashionBrand::create(array('name_en'=>'CHRISTOPHER NEMETH','slug'=>'christopher nemeth','url'=>'http://christophernemeth.co'));
		FashionBrand::create(array('name_en'=>'ALL SAINTS','slug'=>'All-saints','url'=>'http://www.allsaints.co.kr'));
		FashionBrand::create(array('name_en'=>'ESPRIT','slug'=>'esprit','url'=>'http://www.esprit.com'));
		FashionBrand::create(array('name_en'=>'BOTEGA VENETTA','slug'=>'botega-venetta','url'=>'http://www.bottegaveneta.com'));
		FashionBrand::create(array('name_en'=>'MOVE2MOVE','slug'=>'move2move','url'=>'http://www.move2move.kr'));
		FashionBrand::create(array('name_en'=>'MITCHELL&NESS','slug'=>'mitchell&ness','url'=>'http://www.mitchellandness.com'));
		FashionBrand::create(array('name_en'=>'PLAYMONSTERS','slug'=>'playmonsters','url'=>'http://www.playmonsters.co.kr'));
		FashionBrand::create(array('name_en'=>'NASTY PALM','slug'=>'Nasty-palm','url'=>'http://www.hyperround.com'));
		FashionBrand::create(array('name_en'=>'ROMANTIC CROWN','slug'=>'romantic-crown','url'=>'http://www.romanticcrown.com'));
		FashionBrand::create(array('name_en'=>'OBEY','slug'=>'obey','url'=>'http://obeyclothing.co.kr'));



	}

}