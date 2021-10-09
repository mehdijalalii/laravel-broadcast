<template>
    <div>
        <ul>
            <li v-for="task in tasks" v-text="task" :key="task"></li>
        </ul>
        <input type="text" v-model="newTask" @blur="addTask" style="border: 1px black solid;">
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: [],
            newTask: ''
        }
    },

    created() {
        axios.get('/tasks').then(response => (this.tasks = response.data));

        window.Echo.channel('tasks').listen('TaskCreated', ({task}) => {
            this.tasks.push(task.body);
        });
    },

    methods: {
        addTask() {
            axios.post('/tasks', { body: this.newTask });
            this.tasks.push(this.newTask);
            this.newTask = '';
        }
    }
}
</script>

<style>

</style>
