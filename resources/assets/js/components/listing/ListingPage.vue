<template>
     <div>
    <div class="header">
    <div class="header-img" v-bind:style="headerImageStyle" v-on:click="modalOpen = true">

      <button class="view-photos">View Photos</button>
    </div>
  </div>
  <div class="container">
    <div class="heading">
      <h1>{{ apartments.title }}</h1>
      <p>{{ apartments.location }}</p>
    </div>
    <hr>
    <div class="about">
      <h3>About this listing</h3>
      <p >{{ apartments.description  }}</p>
    </div>
    <div class="lists">
      <hr>
      <div class="amenities list">
        <div class="title"><strong>Amenities</strong></div>
        <div class="content">
          <div class="list-item" v-for="amenity in amenities">
            <i class="fa fa-lg" v-bind:class="amenity.icon"></i>
            <span>{{ amenity.title }}</span>
          </div>
        </div>
      </div>
      <hr>
      <div class="prices list">
        <div class="title">
          <strong>Prices</strong>
        </div>
        <div class="content">
          <div class="list-item" v-for="price in prices">
            {{ price.title }}: <strong>{{ price.value }}</strong>
          </div>
        </div>
      </div>
      <div class="title">
          <strong>Reviews</strong>
        </div>
        <div class="content">
          <br>
          </div>
      <section v-for="res, index in reviews" class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
            <header class="section__play-btn mdl-cell mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--blue-100 mdl-color-text--white" >
              
            </header>
            <div class="mdl-card mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
              <div class="mdl-card__supporting-text">
               <h4>{{ res.title  }} </h4>
                {{ res.reviewText }}
              </div>
              <div class="mdl-card__actions">
                Rating: {{ res.rating }}/10
              </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn1">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn1">
              <li class="mdl-menu__item">view</li>
              <li class="mdl-menu__item" disabled>edit</li>
            </ul>
          </section>

    </div>
  </div>
<div id="modal" v-bind:class="{ show : modalOpen }">
        <button v-on:click="modalOpen = false" class="modal-close">
            
        </button>
        <div class="modal-content">
            <img src="images/header.jpg"/>

        </div>


    </div>
</div>


</template>

<script>
    export default {
         data: function () {
            return {
                apartments: [],
                reviews: [],
                 amenities: [
    {
      title: 'Wireless Internet',
      icon: 'fa-wifi'
    },
    {
      title: 'Pets Allowed',
      icon: 'fa-paw'
    },
    {
      title: 'TV',
      icon: 'fa-television'
    },
    {
      title: 'Kitchen',
      icon: 'fa-cutlery'
    },
    {
      title: 'Breakfast',
      icon: 'fa-coffee'
    },
    {
      title: 'Laptop friendly workspace',
      icon: 'fa-laptop'
    }
  ],
  prices: [
    {
      title: 'Per night',
      value: '$89'
    },
    {
      title: 'Extra people',
      value: 'No charge'
    },
    {
      title: 'Weekly discount',
      value: '18%'
    },
    {
      title: 'Monthly discount',
      value: '50%'
    }
  ],
  headerImageStyle: {
                    'background-image': 'url(images/header.jpg)'
        },
        modalOpen: false,
            }
        },
        mounted() {
            let app = this;

            let id = app.$route.params.id;

            axios.get(process.env.MIX_API_URL+'api/apartments/'+id)
                .then(function (resp) {
                    app.apartments = resp.data.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load apartments");
                });


            axios.get(process.env.MIX_API_URL+'api/apartments/'+ id + '/reviews/')
                .then(function (resp) {
                    app.reviews = resp.data.data;
                    console.log(app.reviews);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load reviews");
                });

        },
        methods: {
        escapeKeyListener: function(evt){
            if (evt.keyCode == 27 && this.modalOpen){
                this.modalOpen = false;
            }
        }
    },
    watch: {
        modalOpen: function(){
            var className = 'modal-open';
            if(this.modalOpen){
                document.body.classList.add(className);
            } else {
                document.body.classList.remove(className);
            }
        }
    },
    created: function(){
        document.addEventListener('keyup', this.escapeKeyListener);
    },
    destroyed: function(){
        document.removeEventListener('keyup', this.escapeKeyListener);
    }

        
        
    }
</script>
<style>

body {
  font-family: 'Open Sans', sans-serif;
  color: #484848;
  font-size: 17px;
  margin: 0;
}


.container {
  margin: 0 auto;
  padding: 0 12px;
}

@media (min-width: 744px) {
  .container {
    width: 696px;
  }
}



.heading {
  margin-bottom: 2em;
}

.heading h1 {
  font-size: 32px;
  font-weight: 700;
}

.heading p {
  font-size: 15px;
  color: #767676;
}

hr {
  border: 0;
  border-top: 1px solid #dce0e0;
}

.about {
  margin: 2em 0;
}

.about h3 {
  font-size: 22px;
}

.about p {
  white-space: pre-wrap;
}

.header {
  height: 320px;
}

.header .header-img {
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 50% 50%;
  background-color: #f5f5f5;
  height: 100%;
  cursor: pointer;
  position: relative;
}

.list {
  display: flex;
  flex-wrap: nowrap;
  margin: 2em 0;
}

.list .title {
  flex: 1 1 25%;
}

.list .content {
  flex: 1 1 75%;
  display: flex;
  flex-wrap: wrap;
}

.list .list-item {
  flex: 0 0 50%;
  margin-bottom: 16px;
}

.list .list-item > i {
  width: 35px;
}

@media (max-width: 743px) {
  .list .title {
    flex: 1 1 33%;
  }

  .list .content {
    flex: 1 1 67%;
  }

  .list .list-item {
    flex: 0 0 100%;
  }

}

.about p.contracted {
  height: 250px;
  overflow: hidden;
}

button {
  text-align: center;
  vertical-align: middle;
  user-select: none;
  white-space: nowrap;
  cursor: pointer;
  display: inline-block;
  margin-bottom: 0;
}

.about button.more {
  background: transparent;
  border: 0;
  color: #008489;
  padding: 0;
  font-size: 17px;
  font-weight: bold;
}

.about button.more:hover,
.about button.more:focus,
.about button.more:active {
  text-decoration: underline;
  outline: none;
}

.header .header-img button {
  font-size: 14px;
  padding: 7px 18px;
  color: #484848;
  line-height: 1.43;
  background: #ffffff;
  font-weight: bold;
  border-radius: 4px;
  border: 1px solid #c4c4c4;
}

.header .header-img button.view-photos {
  position: absolute;
  bottom: 20px;
  left: 20px;
}

#modal {
  display: none;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 2000;
  background-color: rgba(0,0,0,0.85);

}

#modal.show {
  display: block;
}

.modal-content {
  height: 100%;
  max-width: 105vh;
  padding-top: 12vh;
  margin: 0 auto;
  position: relative;
}

.modal-content img {
  max-width: 100%;
}

body.modal-open {
  overflow: hidden;
  position: fixed;
}


.modal-close {
  cursor: pointer;
  position: absolute;
  right: 0;
  top: 0;
  padding: 0px 28px 8px;
  font-size: 4em;
  width: auto;
  height: auto;
  background: transparent;
  border: 0;
  outline: none;
  color: #ffffff;
  z-index: 1000;
  font-weight: 100;
  line-height: 1;
}


</style>

