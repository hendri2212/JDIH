<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Berita Terbaru</h5>
        <div class="owl-carousel">
            <router-link :to="{ name: 'news' }" class="text-decoration-none text-dark text-wrap" style="width: 270px">
                <img src="https://i.pinimg.com/564x/3c/22/7d/3c227d050c489eca380f04ac1ded0d36.jpg" class="rounded-3" style="height: 150px; width: 270px">
                <h6 class="mt-2 lh-base" style="width: 270px">Calon Suami Kabur di Hari Pernikahan, Gadis di Palembang Lapor Polisi</h6>
            </router-link>
            <div class="" style="width: 270px">
                <img src="https://png.pngtree.com/thumb_back/fh260/back_pic/00/01/58/10560539654f18c.jpg" class="rounded-3" style="height: 150px">
                <h6 class="mt-2 lh-base">Profil Yudi dan Danu, Hakim PN Rangkasbitung yang Ditangkap BNN karena Sabu</h6>
            </div>
            <div class="" style="width: 270px">
                <img src="https://i.pinimg.com/564x/41/6a/12/416a12455b40de67fb2825ce9985fb7e.jpg" class="rounded-3" style="height: 150px">
                <h6 class="mt-2 lh-base">Pria di Majalengka yang Sebar Teror Bom dan Ancam Teller Bank Diciduk Polisi</h6>
            </div>
        </div>
    </main>
</template>
<script type="text/javascript">
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin      : 10,
            loop        : true,
            autoWidth   : true,
            items       : 3
        });
    });
</script>