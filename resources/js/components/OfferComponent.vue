<template>
  <div class="mark_offer_container">
    <div class="vue_offer_status">
      <div v-if="this.status == 1" class="star-rating">
        <label class="star-rating__star" v-for="rating in ratings"  :key="rating.id" 
        :class="{'is-selected': ((value >= rating) && value != null), 'is-disabled': disabled}"
        v-on:click="set(rating)" v-on:mouseover="star_over(rating)" v-on:mouseout="star_out">
        
        <input class="star-rating star-rating__checkbox" type="radio" :value="rating" :name="name"
        v-model="value" :disabled="disabled">★</label>
    </div>
    </div>

    <div v-if="this.status == 0" class="vue_offer_status">
      <input type="number" v-model="status" style="display:none">
      <input type="number" v-model="resp_id" style="display:none">
      <button @click="Accept" class="offer_send_btn">Пригласить</button>
    </div>
    <div v-else class="vue_offer_status">
      <input type="number" v-model="status" style="display:none">
      <input type="number" v-model="resp_id" style="display:none">
      <button @click="Cancel" class="offer_send_btn">Отменить</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: 0,
      resp_id: 0,
      value: 0,
      temp_value: null,
      ratings: [1, 2, 3, 4, 5]
    };
  },
  props: [
    'respid',
    'jobid',
    'name',
    'id',
    'disabled',
    'required',
    'userid'
    ],
  mounted() {
    this.update();
  },
  methods: {
    update: function() {
      axios.get("/json_offer").then(response => {
        if (response.data != null) {
          response.data.forEach(element => {
              if (this.respid == element["id"]) {
                this.status = element["status"];
              }
          });
        }
      });

      axios.get("/json_rating").then(response => {
        if (response.data != null) {
          response.data.forEach(element => {
              if (this.jobid == element["job_id"] && this.userid == element["user_id"]) {
                this.value = element["rating"];
              }
          });
        }
      });
    },
    Accept: function() {
      axios.patch("/responds/0", { status: 1, resp_id: this.respid });
      this.status = 1;
    },
    Cancel: function() {
      axios.patch("/responds/0", { status: 0, resp_id: this.respid });
      this.status = 0;
    },

     /*
     * Behaviour of the stars on mouseover.
     */
    star_over: function(index) {
      var self = this;

      if (!this.disabled) {
        this.temp_value = this.value;
        return this.value = index;
      }

    },

    /*
     * Behaviour of the stars on mouseout.
     */
    star_out: function() {
      var self = this;

      if (!this.disabled) {
        return this.value = this.temp_value;
      }
    },

    /*
     * Set the rating.
     */
    set: function(value) {
      var self = this;

      if (!this.disabled) {
        this.temp_value = value;         
        axios.patch("/rating", { rating: this.value, job_id: this.jobid, user_id: this.userid });  
        return this.value = value;
      }
      
    }
  }
};
</script>
<style lang="scss">
%visually-hidden {
  position: absolute;
  overflow: hidden;
  clip: rect(0 0 0 0);
  height: 1px; width: 1px;
  margin: -1px; padding: 0; border: 0;
}

.star-rating {

  &__star {
    display: inline-block;
    vertical-align: middle;
    line-height: 1;
    font-size: 1.5em;
    color: #ABABAB;
    transition: color .2s ease-out;

    &:hover {
      cursor: pointer;
    }
    
    &.is-selected {
      color: #FFD700;
    }
    
    &.is-disabled:hover {
      cursor: default;
    }
  }

  &__checkbox {
    @extend %visually-hidden;
  }
}

</style>