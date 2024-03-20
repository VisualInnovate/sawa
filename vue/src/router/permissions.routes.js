// permissions

const Index = () => import("@/views/permissions/index.vue");


const permissionsRoutes = [
  {
    path: "permissions",
    name: "permissions",
    component: Index,
   
  },
  // create
 
];

export default {
  ...permissionsRoutes,
};
