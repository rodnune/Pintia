<div id="splash">
    <img  id="splashimage" src="" alt="" width="1250px" height="300px" />
    <script language="JavaScript" type="text/javascript">

        window.onload = choosePic;

        var myPix = new Array("images/splash2.jpg","images/splash3.jpg");

        function choosePic() {
            var randomNum = Math.floor(Math.random() * myPix.length);
            document.getElementById("splashimage").src = myPix[randomNum];
        }
    </script>
</div>