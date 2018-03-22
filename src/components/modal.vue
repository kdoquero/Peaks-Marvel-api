<template>
    <div>
        <b-modal class="container-modal" v-model="modalShow" hide-footer :title="hero.name">
            <div class="portrait-details" :style="{ backgroundImage:`url(${hero.thumbnail.path}.${hero.thumbnail.extension})`}">    
                </div>
            <div class="d-block text-center">
                <div>

                </div>
                <p>{{hero.description}}</p>
                <p> Appear in : {{hero.comics.available}} comics</p>
                <div v-for="(item,index) in hero.comics.items.slice(0, 3)" :key="index" >
                    <p>{{item.name}}</p>
                </div>
            </div>
        </b-modal>
        <h6  @click="modalShow = !modalShow" >{{hero.name}}</h6><i class="fas fa-star"></i>
    </div>
  
</template>

<script>
export default {
  name: "modal",
   props: {
        hero: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            modalShow: false
        }
    },
    methods:{
       
        
    }
};
</script>

<style>
h5 {
    color: black;
}
h6 {
    color: white;
}
h6:hover {
    color: red;
}

.portrait-details {
    width: 200px;
    height: 200px;
    background-size: cover;
    background-repeat: no-repeat;
}
.container-modal {
    display: flex;
    justify-content: center;
    color: black;
}
.modal-body {
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
