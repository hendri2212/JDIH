<template>
    <main class="bg-white p-3 my-2">
        <h5>Berita Terbaru</h5>
        <div class="carouselku">
            <div class="slick-slide">
                <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg">
            </div>
            <div class="slick-slide">
                <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg">
            </div>
            <div class="slick-slide">
                <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg">
            </div>
            <div class="slick-slide">
                <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg">
            </div>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide my-3" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://png.pngtree.com/thumb_back/fh260/back_pic/00/01/58/10560539654f18c.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://i.pinimg.com/564x/41/6a/12/416a12455b40de67fb2825ce9985fb7e.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </main>
</template>