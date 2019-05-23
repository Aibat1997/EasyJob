<template>
  <div style="width: 18%;" class="vue_send_btn">
    <p v-if="this.offer == 1" class="sended_offer">Вы откликнулись</p>
    <button @click="sendData" v-else class="send_offer">Откликнуться</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      offer: null,
    };
  },
  props: [
      'jobid',
  ],
  mounted() {
    this.update();
  },
  methods: {
    update: function() {
      axios.get("/json_send").then(response => {
        if (response.data != null) {
          response.data.forEach(element => {
              if (this.jobid == element["job_id"]) {
                this.offer = element["send"];
              }
          }); 
        }       
      });
    },
    sendData: function() {
      axios.post("/offers/0", { job_id: this.jobid, offer: 1 });
      this.offer = 1;
    }
  }
};
</script>
