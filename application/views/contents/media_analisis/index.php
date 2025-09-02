<style>
.iframe-container {
    position: relative;
    width: 100%;
    /* height: 100%; */
    height: 100vh; /* Use viewport height to fill the screen */
}
iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none; /* Remove default border */
}
</style>

<div class="iframe-container">
    <iframe src="https://asoca.komnasham.go.id/pusdahamnas?key=<?php echo $asoca_key;?>" title="Asoca"></iframe>
</div>

