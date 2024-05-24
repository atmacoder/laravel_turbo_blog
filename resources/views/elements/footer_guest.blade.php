<div class="container">
<nav class="navbar navbar-expand-lg p-0">
    <div class="container border-0 p-4 rounded-3 text-center d-block footer">
            <div class="footer-info">
            {!!$settings['data']['info_blog_footer']  !!}
            </div>
        </div>
    <div id="scroll-top"></div>

</nav>
</div>
<style>
    #scroll-top {
        width: 70px;
        height: 70px;
        right: 50px;
        bottom: calc(100px);
        z-index: 1000;
        color: rgb(255, 255, 255);
        background-color: {{$settings['data']['scroll_top_background']}};
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg version=%271.1%27 xmlns=%27http://www.w3.org/2000/svg%27 width=%2710px%27 height=%2710px%27%3E %3Cpolygon fill=%27%23ffffff%27 stroke=%27none%27 points=%278.589,6.945 5,3.22 1.413,6.945 1.052,6.598 5,2.499 8.948,6.598%27 /%3E %3C/svg%3E");
        box-shadow: rgba(0, 0, 0, 0.3) 1px 1px 2px;
        border-radius: 50%;
        overflow: hidden;
        position: fixed;
        cursor: pointer;
        background-repeat: no-repeat;
        background-position: 50% 50%;
        background-size: 70% auto;
        white-space: nowrap;
        text-indent: 100%;
        transition: all 1.5s ease-in-out;
    }
</style>
<script>
    window.addEventListener('scroll', function() {
        if (document.documentElement.scrollTop > 1200) {
            document.querySelector('#scroll-top').style.opacity = 1;
            document.querySelector('#scroll-top').style.visibility = 'visible';
        } else {
            document.querySelector('#scroll-top').style.opacity = 0;
            document.querySelector('#scroll-top').style.visibility = 'hidden';
        }
    });

    document.querySelector('#scroll-top').addEventListener('click', function() {
        document.documentElement.scrollTop = 0;
    });
</script>
<style>
    .footer-info{
        color:{{$settings['data']['footer_text_color']}};
        text-shadow: 0px 0.5px 0px #fff, 0px 1px 0px #ccc, 0px 2px 0px #999;
    }
    .footer-main {
        width: 100%;
        background-image: url('{{$settings['data']['imageBackgroundFooter']}}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center 1px;
        display: flex;
    }
</style>
