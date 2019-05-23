<template>
  <div class="mark_offer_container" v-if="star_cnt != 0 && !isNaN(star_cnt)">
    {{star_cnt}}<span class="user_star">&#9733;</span>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user_id: this.userid,
      star_cnt: null,
    };
  },
  props: [
      'userid'
    ],
  mounted() {
    this.update();
  },
  methods: {
    update: function() {
      axios.get("/json_rating").then(response => {
        if (response.data != null) {
          var i = 0;
          response.data.forEach(element => {
              if (this.userid == element["user_id"] && element["rating"] != 0) {
                i++;
                this.star_cnt += element["rating"];
              }
          });
          this.star_cnt = (this.star_cnt/i).toFixed(1);
        }
      });
    },
  }
};
</script>