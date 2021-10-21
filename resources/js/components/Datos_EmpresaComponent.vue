<template>
            <main class="main">
  <div id="app" class="container my-3">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="mb-3">Upload Image</h1>
    </div>
    <div class="col-md-5 offset-md-1">
      <h5>1. single file</h5>
      <form>
        <div class="form-group">
          <label for="my-file">Select Image</label>
          <input type="file" accept="image/*" @change="previewImage" class="form-control-file" id="my-file">
    
          <div class="border p-2 mt-3">
            <p>Vist Previa:</p>
            <template v-if="preview">
              <img :src="preview" class="img-fluid" height="100px" width="100px" />
              <p class="mb-0">Nombre: {{ image.name }}</p>
              <p class="mb-0">Size: {{ image.size/1024 }}KB</p>
            </template>
          </div>
        </div>
      </form>
    </div>
    
    
    <div class="w-100"></div>
    <div class="col-12 mt-3 text-center">
      <p class="text-primary">* You should send data "image" & "image_list" via API to upload image files.</p>
      Reset input file <button @click="reset">Clear All</button>
    </div>
  </div>
</div>
        </main>
</template>
<style >
.imagePreviewWrapper {
    width: 50px;
    height: 50px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: cover;
    background-position: center center;
}
</style>
<script>
export default {
 
  data() {
        return {
      preview: null,
      image: null,
      preview_list: [],
      image_list: []
    }
    },
    methods: {
        previewImage: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview = e.target.result;
        }
        this.image=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    
    reset: function() {
      this.image = null;
      this.preview = null;
      this.image_list = [];
      this.preview_list = [];
    }
    }
}
</script>
 