import './bootstrap';
import { createApp, ref } from 'vue';
import DepartmentComponent from './components/DepartmentsComponent.vue';
import ShiftsComponent from './components/ShiftsComponent.vue';
import EmployeesComponent from './components/EmployeesComponent.vue';
import ActivitiesComponent from './components/ActivitiesComponent.vue';
import CheckListComponent from './components/CheckListComponent.vue';
import AttendanceComponent from './components/AttendanceComponent.vue';

const app = createApp({
    setup() {
    }
});

app.component('departments-component', DepartmentComponent);
app.component('shifts-component', ShiftsComponent);
app.component('employees-component', EmployeesComponent);
app.component('activities-component', ActivitiesComponent);
app.component('checklist-component', CheckListComponent);
app.component('attendance-component', AttendanceComponent);


app.mount('#app');