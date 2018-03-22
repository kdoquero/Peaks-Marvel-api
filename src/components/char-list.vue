<template>
    <section>
        <div class="container" >
            <div class="container-hero" v-for=" hero of heroes" :key="hero.id">
                <div class="portrait" :style="{ backgroundImage:`url(${hero.thumbnail.path}.${hero.thumbnail.extension})`}">    
                </div>
                <modal :hero= "hero"/>
            </div>
            
        </div>
    </section>
</template>

<script>
import modal from './modal'
export default {
    name: "chart-list",
    props: {
        heroes: {
            type: Array,
            required: true
        }
    },
    components: {
        modal
    },
    data(){
        return {
            modalShow: false
        }
    },
    methods:{

    }
}
</script>

<style>
h5 {
    color: white;
}
.container-hero {
    display: flex;
    flex-direction: column;
    width: 25vw;
    align-items: center;
    border: 5px solid black;
    margin: 10px;
    padding: 15px;
    background-color: rgba(0, 0, 0, 0.392) ;
    
}
.container-hero:hover {
    border: 5px solid red;
}
.container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}
.portrait {
    width: 100px;
    height: 100px;
    background-size: cover;
    background-repeat: no-repeat;
}
.modal-backdrop {
    background-color: rgba(0,0,0,.0001) !important;
}

</style>
