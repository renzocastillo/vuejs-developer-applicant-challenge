<template>
  <h1>This is the table page</h1>
  <TableComponent :fields='fields' :items ="studentData"/>
</template>


<script type="setup" lang="ts">
// Importing the table component
import TableComponent from "@/components/TableComponent.vue";
export default {
  name: 'AdminTable',
  components: {
    TableComponent
  },
  setup(){
    const studentData = [
      {ID:"01", Name: "Abiola Esther", Course:"Computer Science", Gender:"Female", Age:"17"},
      {ID:"02", Name: "Robert V. Kratz", Course:"Philosophy", Gender:"Male", Age:'19'},
      {ID:"03", Name: "Kristen Anderson", Course:"Economics", Gender:"Female", Age:'20'},
      {ID:"04", Name: "Adam Simon", Course:"Food science", Gender:"Male", Age:'21'},
      {ID:"05", Name: "Daisy Katherine", Course:"Business studies", Gender:"Female", Age:'22'},
    ]
    const fields = [
      'ID','Name','Course','Gender','Age'
    ]
    return{studentData,fields}
  },
}
</script>

