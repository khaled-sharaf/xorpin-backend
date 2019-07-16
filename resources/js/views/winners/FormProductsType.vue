<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- name -->
                <div class="form-group">
                    <label>Name <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    placeholder="Products type name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>



                <!-- dispaly products -->
                <div class="form-group">
                    <label>Show products of this type<span class="field-required"></span></label>
                    <select
                    v-model="form.display"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('display') }"
                    >
                    <option
                        v-for="(display, i) in displayArr"
                        :value="display.value"
                        :key="i"
                    >{{ display.text }}</option>
                    </select>
                    <has-error :form="form" field="display"></has-error>
                </div>

            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>
  export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        displayArr: [
          { text: "Visible products", value: 1 },
          { text: "Hidden products", value: 0 }
        ],
      }
    }
  }
</script>
