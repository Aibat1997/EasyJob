<template>
  <div>
    <div class="moder_job_container">
        <div class="moder_job_block" v-if="job.status == null">
          <div class="moder_job_content">
            <p>Название: {{job.title}}</p>
            <p>Категория: {{job.category}}</p>
            <p>Цена: {{job.cost}}</p>
            <p>Кол-во чел: {{job.num_persons}}</p>
            <p>Адрес: {{job.region}} р-н, {{job.address}}</p>
            <p>Срок(год-месяц-день): <br> С {{job.start_date}} до {{job.final_date}}</p>
            <p>Описание: {{job.description}}</p>
          </div>
          <div class="moder_actions">
            <button @click="Accept">Принять</button>
            <button @click="Cancel">Отклонить</button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: null,
      job:{},
    };
  },
  props: [
    'jobid'
    ],
  mounted() {
    this.update();
  },
  methods: {
    update: function() {
      axios.get("/moderator_side/job_json").then(response => {
        if (response.data != null) {
          response.data.forEach(element => {
              if (this.jobid == element["id"]) {
                this.job = element;
              }
          });
        }
      });
    },
    Accept: function() {
      axios.patch("/moderator_side/page_for_login_moderator/index", { status: 1, job_id: this.jobid });
      this.job.status = 1;
    },
    Cancel: function() {
      axios.patch("/moderator_side/page_for_login_moderator/index", { status: 0, job_id: this.jobid });
      this.job.status = 0;
    },
  }
};
</script>