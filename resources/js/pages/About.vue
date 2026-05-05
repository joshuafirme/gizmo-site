<template>

    <section id="about" class="about-section pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img wow fadeInUp" data-wow-delay=".5s">
                        <img :src="data?.about_cover_image" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
                            <h1 class="wow fadeInUp" data-wow-delay=".4s">{{ data.about.title }}
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay=".6s">{{ data.about.description }}</p>
                        </div>
                        <!-- <div class="counter-up wow fadeInUp" data-wow-delay=".8s">
                            <div class="single-counter" v-for="(stat, i) in stats" :key="i">
                                <h3 :id="'secondo'+i" class="countup" :cup-end="i" cup-append="M+">{{stat.value}}</h3>
                                <h5>{{stat.label}}</h5>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>

export default {
    props: {
        data: Object
    }
};
</script>