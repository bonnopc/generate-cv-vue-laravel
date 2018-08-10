<<template>
  <div>
      <div class="footer">Copyright &copy; {{thisYear}} GenerateCV</div>
  </div>
</template>

<<script>
export default {
    data(){
        return{
            thisYear: ''
        }
    },
    mounted() {
        this.thisYear = moment().year();
    },
}
</script>