// permissions



const rooms = [
    {
        path: '/add-room', // Define the path for your addRoom route
        name: 'addRoom',
        component: () => import("../views/rooms/Create.vue")
      },
    { 
        path: '/rooms',
        name: 'Rooms',
      component: () => import("../views/rooms/Index.vue")
    },
    {
      path: '/create-room', 
      name: 'CreateRoom',
      component: () => import("../views/rooms/Create.vue")
    },
    {
      path: '/test-room', 
      name: 'TestRoom',
      component: () => import("../views/rooms/Test.vue")
    },
    {
    path: '/edit-room/:id',
    name: 'EditRoom',
    component: () => import("../views/rooms/Edit.vue")
    },
];

export default {
  ...rooms,
};
