<footer id="footer">
    <p>CaseStudy © 2024</p>
</footer>
<script>
    function adjustFooterPosition() {
        var contentHeight = document.body.scrollHeight;
        var windowHeight = window.innerHeight;

        if (contentHeight < windowHeight) {
            document.getElementById('footer').style.position = 'absolute';
            document.getElementById('footer').style.bottom = '0';
        } else {
            document.getElementById('footer').style.position = 'static';
        }
    }

    window.addEventListener('load', adjustFooterPosition);
    window.addEventListener('resize', adjustFooterPosition);
</script>
</body>
</html>
