var a=0


	function share()
	{
		a=a+1;
		document.getElementById("numbers").innerHTML=a;
	}

	function post(){
		var post=document.getElementById("exampleFormControlTextarea1").value
		document.getElementById("newFeeds").innerHTML=` 
		<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="container makepost">
							<div class="row post-header justify-content-between ml-2">
								<div class="col-7">
									<img class="p-rofil" src="res/profile1.png">	<span class="nama ml-3 align-middle">Pacar Muhammad Basurah</span>
								</div>
								<div class="col-3">
									<div class="btn btn-primary tombol" href="#">
										Categories: Curhat
									</div>
								</div>
							</div>
							<div class="row input-status justify-content-center" style="margin-top:39px">
								<div class="col-md-10">
									<span id="status">`+post+`</span>
								</div>
							</div>
							<div class="row post-menu mt-5 ml-5 justify-content-between">
								<div class="col-4">
									<div class="datetime">
										<span class=date>7</span> / <span class=month>November</span> / <span class=year>2020</span>
									</div>
								</div>
                                <div class="col-4">
                                <div class="row justify-content-center  text-center">
                                    <div class="col-5 my-auto">
                                        <a onclick=displayKomen()><img src="res/komen.png"></a>
                                        <span id=numbers>0</span>
                                    </div>
                                    <div class="col-7 my-auto">
                                        <a onclick=share()><img src="res/up.png" width=60px></a>
                                        <span id=numbers style="margin-left:-10px;">0</span>
                                    </div>
                                </div>
                            </div>
							</div>
						</div>
					</div>
				</div>
			</div>	`;
	}


	function displayKomen(){
		var status=1;
		if(status==1){
			document.getElementById("kolomKomentar").innerHTML=`
			<!-- Comment Section -->
				<div class="row justify-content-center" style="margin-top:-90px; margin-left:50px">
					<div class="col-lg-9">
						<!-- Isi Comment Section -->
						<div class="makepost komentar">
							<!-- Blok Komentar -->
							<div class="container mb-4 komentar">
								<div class="row justify-content-between">
									<div class="col-1">
										<img src="res/profile1.png" style="width:37px;">
									</div>
									<div class="col-7">
										Pacar Orang
									</div>
									<div class="col-4">
										7 / November / 2020
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-10">
										Cute Bangeeeetttt....
									</div>
								</div>
							</div>
							<!-- End of Blok Komentar -->
							<hr>
							<!-- Blok Komentar -->
							<div class="container mb-4 komentar">
								<div class="row justify-content-between">
									<div class="col-1">
										<img src="res/profile1.png" style="width:37px;">
									</div>
									<div class="col-7">
										Pacar Orang
									</div>
									<div class="col-4">
										7 / November / 2020
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-10">
										Cute Bangeeeetttt....
									</div>
								</div>
							</div>
							<!-- End of Blok Komentar -->
							<hr>
							<!-- Blok Komentar -->
							<div class="container mb-4 ">
								<div class="row justify-content-start ">
									<div class="col-1">
										<img src="res/profile1.png" style="width:37px;">
									</div>
									<div class="col-6">
										<span>Pacar Orang</span>
										<span style="margin-left:7%;">7 / November / 2020</span>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-10">
										Cute Bangeeeetttt....
									</div>
								</div>
							</div>
							<!-- End of Blok Komentar -->
							<!-- Input Komen -->
							<div class="input-group mb-3">
								<input type="text" class="form-control form-komen" placeholder="Tulis Komentar Anda..." aria-label="Recipient's username" aria-describedby="button-addon2">
								<div class="input-group-append">
								  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
								</div>
							</div>
							<!-- End of input komen -->
						</div>
					</div>
					<div class="col-lg-2">

					</div>
				</div>
			`;
			status=0;
		}
		else{
			document.getElementById("kolomKomentar").innerHTML="";
		}
	}

