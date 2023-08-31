
			<section class="main-menu" >
				<div class="menuItem" style="margin-top: 25px; ">
					<img src="images/logo.webp" alt="logo" width="35px" height="35px" style="margin-right: 10px; ">

					<a class="text mini" style="font-weight: 700; font-size: 16px;">AKUETTO</a>
				</div>
				
				<a class="cursor" href = "index.php">
					<div class="menuItem">
						<img src="images/homeWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<label href = "index.php" class="cursor text">Главная</label>
					</div>
				</a>

				<a class="cursor" href = "search.php">
					<div class="menuItem">
						<img src="images/searchWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<a href = "search.php" class="cursor text">Поиск</a>
					</div>
				</a>

				<a class="cursor" href = "favorite.php">
					<div class="menuItem">
						<img src="images/heartWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<a href = "favorite.php" class="cursor text">Избранное</a>
					</div>
				</a>

				<a class="cursor" href = "favoriteArt.php">
					<div class="menuItem">
						<img src="images/artist.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						<a href = "favoriteArt.php" class="cursor text">Избранные артисты</a>
					</div>
				</a>

				<hr class='menuHr'>

				
				<a class="cursor" href = "playlistCreation.php">
					<div class="menuItem">
						<img src="images/plusWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<a href = "playlistCreation.php" class="cursor text">Создать плейлист</a>
					</div>
				</a>

				<?php if ($_COOKIE['admin']=='1'): ?>
					<hr class='menuHr'>
				<a class="cursor" href = "songCreation.php">
					<div class="menuItem">
						<img src="images/plusWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<a href = "songCreation.php" class="cursor text">Добавить песню</a>
					</div>
				</a>
				<a class="cursor" href = "artistCreation.php">
					<div class="menuItem">
						<img src="images/plusWhite.png" alt="mainPage" width="30px" height="30px" style="margin-right: 10px; ">
						
						<a href = "artistCreation.php" class="cursor text">Добавить артиста</a>
					</div>
				</a>
				<?php endif; ?> 
			</section>