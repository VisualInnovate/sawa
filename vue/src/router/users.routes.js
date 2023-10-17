// users

const Index = () => import("@/views/users/Index.vue");
const Show = () => import("@/views/users/Show.vue");
const Edit = () => import("@/views/users/Edit.vue");
const Create = () => import("@/views/users/Create.vue");

const usersRoutes = [
  {
    path: "users",
    name: "Users",
    component: Index,
    meta: {
      permissions: ["users.index"],
    },
  },
  // create
  {
    path: "users/create",
    name: "CreateUser",
    component: Create,
    meta: {
      permissions: ["users.create"],
    },
  },
  // show
  {
    path: "users/:id",
    name: "ShowUser",
    component: Show,
    meta: {
      permissions: ["users.show"],
    },
  },
  // edit
  {
    path: "users/:id/edit",
    name: "EditUser",
    component: Edit,
    meta: {
      permissions: ["users.edit"],
    },
  },
];

export default {
  ...usersRoutes,
};
