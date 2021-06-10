<template>
    <div class="card">
        <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" v-bind:src="image" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">{{ message }}</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
</template>

<script>
export default {
     setup: () => ({
        card: 'Grupo de CARDS',
    }),
    props: {
        title: String,
        message: String,
        image: String,
    },
}
</script>
