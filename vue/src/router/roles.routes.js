// roles

const Index = () => import("@/views/roles/Index.vue");
const Show = () => import("@/views/roles/Show.vue");
const Edit = () => import("@/views/roles/Edit.vue");
const Create = () => import("@/views/roles/Create.vue");
const UserRoles = () => import("@/views/roles/UserRoles.vue");
const RolesUsers = () => import("@/views/roles/RolesUsers.vue");
const UserRoleDelete = () => import("@/views/roles/UserRoleDelete.vue");

const rolesRoutes = [
  {
    path: "roles",
    name: "Roles",
    component: Index,
    meta: {
      permissions: ["roles.index"],
    },
  },
  // create
  {
    path: "roles/create",
    name: "CreateRole",
    component: Create,
    meta: {
      permissions: ["roles.create"],
    },
  },
  // show
  {
    path: "roles/:id",
    name: "ShowRole",
    component: Show,
    meta: {
      permissions: ["roles.show"],
    },
  },
  // edit
  {
    path: "roles/:id/edit",
    name: "EditRole",
    component: Edit,
    meta: {
      permissions: ["roles.edit"],
    },
  },
  {
    path: "roles/users",
    name: "RolesUsers",
    component: RolesUsers,
    meta: {
      permissions: ["roles.index"],
    },
  },
  {
    path: "roles/user/:id/roles",
    name: "UserRole",
    component: UserRoles,
    meta: {
      permissions: ["roles.create"],
    },
    props: true,
  },
  {
    path: "roles/user/:id/roles/sync",
    name: "UserRoleDelete",
    component: UserRoleDelete,
    meta: {
      permissions: ["roles.create"],
    },
    props: true,
  },
];

export default {
  ...rolesRoutes,
};
