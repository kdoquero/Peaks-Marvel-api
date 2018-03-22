<template>
    <div>
        <b-modal v-model="modalShow" hide-footer :title="hero.name">
            <div class="d-block text-center">
                <div>
                    
                </div>
                <p>{{hero.description}}</p>
                <p>{{hero.comics.available}}</p>
                <div v-for="(item,index) in hero.comics.items.slice(0, 3)" :key="index" >
                    <p>{{item.name}}</p>
                </div>
            </div>
        </b-modal>
        <i @click="modalShow = !modalShow" class="fas fa-expand-arrows-alt"></i>
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

</style>
