// permissions



const appointment = [
    
  {
    path: '/system-program',
    name: 'SystemProgram',
    component: () => import("../views/Treatment/ProgramSystem.vue")
  },
    {
        path: '/session-type',
        name: 'SessionType',
        component: () => import("../views/Treatment/SessionType.vue")
      },
    {
        path: '/program-type',
        name: 'ProgramType',
        component: () => import("../views/Treatment/TypeProgram.vue")
      },
    {
        path: '/appointment-type',
        name: 'AppointmentType',
        component: () => import("../views/Treatment/AppointmentType.vue")
      },
      {
        path: '/type-treatment',
        name: 'TypeTreatment',
        component: () => import("../views/Treatment/Typetreatment.vue")
      },
      {
        path: '/type-treatment/:id/edit',
        name: 'EditTreatment',
        component: () => import("../views/Treatment/EditTreatment.vue")
      },
];

export default {
  ...appointment,
};
