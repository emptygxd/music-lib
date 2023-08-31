
				<audio class="audio" src="audio/Наивность.mp3"></audio>
				<div class="progress__conteiner">
					<div class="progress"></div>
				</div>
				<div class="bottomButtons">
					<img title="Перемешать" src="images/shuffleWhite.png" id="image"   class="pics shuffle">
					<script src="js/script.js"></script>
					<img title="Передыдущая песня" src="images/rewindWhite.png" class="pics prev" >
					<img title="Поставить на паузу/воспроизвести песню" src="images/playWhite.png" class="pics play" >
					<img title="Следующая песня" src="images/forwardWhite.png" class="pics next" >
					<img title="Повтор" src="images/repeat-buttonWhite.png" class="pics repeat" >
				</div>
			</div> 

			<div class="rightButtons">
				<img title="Выключить звук" src="images/high-volumeWhite.png" class="pics2 volume">
			</div>
			<div class="slider" style="display: flex; align-items: center; margin-left: 8px;">
	        	<input class="cursor" onmousemove="rangeSlider(this.value)" onChange="rangeSlider(this.value)" type="range" id="fader2" min="0" max="100" value="30" step="1">
	      	</div>
      	