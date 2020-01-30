<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->
<?php
	$songs = 5678;
	$news_pages = 5;
	if (isset($_GET["newspages"])) {
		$news_pages = (int) $_GET["newspages"];
	}
	?>
	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="https://www.cs.washington.edu/education/courses/cse190m/12sp/labs/3/viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?= $songs ?> total songs,
			which is over <?= (int) $songs / 10 ?> hours of music!
		</p>

		<!-- Music Results Pages (Loops) -->
		<div class="section">
			<h2>Google's Music Results</h2>
		
			<ol>
				<?php for( $i = 0; $i < $news_pages; $i++ ) { ?>
					<li><a href="https://www.google.com/search?tbm=nws&amp;q=Music&amp;start=<?= $i * 10 ?>">Page <?= $i + 1?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Favorite Artists (Arrays) -->
		<?php
		 #$arr = ["Britney Spears", "Christina Aguilera", "Justin Bieber", "Jack Johnson"]; 
		 $arr = file("favorite.txt");
		?>
		<!-- Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php for ($i = 0; $i < count($arr); $i++) { ?>
					<li><a href="https://www.vevo.com/artist/<?= trim(strtolower(str_replace(" ", "-", $arr[$i]))) ?>/"><?= $arr[$i] ?></a></li>

				<?php } ?>
			</ol>
		</div>

		<!-- Alternate solution:
			<?php foreach (file("favorite.txt", FILE_IGNORE_NEW_LINES) as $artist) {
					$artist_link = implode("-", explode(" ", strtolower($artist)));
					?>

					<li>
						<a href="https://www.vevo.com/artist/<?= $artist_link ?>/"><?= $artist ?></a>
					</li>
					
					<?php
				}
				?>

		-->
		
		<!-- Music (Multiple Files) -->
		<!-- MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
					$items = glob("/*.mp3");
					foreach($items as $item) {
				?> 
				<li class="mp3item">	
					<a href="/cse154/songs/<?=str_replace(" ", "%20", basename($item))?>"><?= basename($item) ?></a> (<?= round(filesize($item) / 1024) ?> KB)
				</li>

				<?php
				}
				?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
				$playlists = glob("/www/html/cse154/songs/*.m3u");
				foreach($playlists as $playlist) {
				?>
				<li class="playlistitem">
						<?= basename($playlist) ?>:
						<ul>
							<?php
							foreach (file($playlist, FILE_IGNORE_NEW_LINES) as $line) {
								if (strpos($line, "#") === FALSE) {
									?>
									<li> <?= $line ?> </li>
									<?php 
								}
							}
							?>
						</ul>
					</li>
				<?php } ?>
			</ul>
		</div>

		<div>
			<a href="https://webster.cs.washington.edu/validate-html.php">
				<img src="http://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://webster.cs.washington.edu/validate-css.php">
				<img src="http://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
