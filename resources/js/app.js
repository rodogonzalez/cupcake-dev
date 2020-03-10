/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import trae from 'trae';
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{        
        map: null ,
        stores: [ ],
        current_store: null
        
    },
    methods: {

        initMap: function (event) {
            


            this.map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 39.09670794173623, lng: -97.4289608},
              zoom: 5
            });

            this.get_stores();
            
          },
        
          render_map: function (event){
            $.each(this.stores, function(key, value) {
                //console.log(value);
                var image = 'https://www.codeshare.co.uk/images/blue-pin.png';			    
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(  value.g_lat) ,lng:parseFloat(value.g_lng)},
                    map: app.map,
                    draggable: false,
                    name: value.name,                    
                    store: this,
                    icon:image 
                  });                   
                
                  marker.addListener('click', function() {                    
                    app.map.setCenter(this.getPosition());                     
                    app.current_store=this.store;

                });
			    
                


              });

        },
          get_stores: function(event){

            const objLoader = trae.create();  

            const result = objLoader.get(
                '/api/get-stores'
            )
            .then( (response)=>{      
                
                
                this.stores = response.data;
                this.render_map();                
                                                               
                return response;
            });
        },
        display_store:function($store_id){


        }


        
    }

});

app.initMap();
