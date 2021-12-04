<header>
    <nav class="narbar">
        <!-- <a href="#">
            <img class="logo" src="icon.jpg" alt="Web's Symbolism" target="_self">
        </a> -->
        <div class="blog-title">
            <a class="blg-tit" href="/IE104_PROJECT/index.html">SeeShareVN</a>
        </div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="narbar-links">
            <ul>
                <li><a href="index.php" target="_self">Home</a></li>
                <li><a href="place.php" target="_self">Place</a></li>
                <!-- <li><a href="usr-blog.html" target="_self">Blog</a></li> -->

                <!-- <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Blog</a>
                    <div class="dropdown-content">
                        <a href="blog-list.html" target="_self">Blog List</a>
                        <a href="blog-sort.html" target="_self">Blog Sort</a>
                    </div>
                </li> -->

                <li><a href="about-us.php" target="_self">About Us</a></li>
                <li><a href="contact-us.php" target="_self">Contact us</a></li>
                <li><a href="donate.php" target="_self">Donate</a></li>
                <li><a href="login.php" target="_self" class="logIn">Log in</a></li>
            </ul>
        </div>
    </nav>

    <script>
        const toggleButton = document.getElementsByClassName('toggle-button')[0]
        const narbarLinks = document.getElementsByClassName('narbar-links')[0]

        toggleButton.addEventListener('click', () => {
            narbarLinks.classList.toggle('active')
        })
    </script>
</header>