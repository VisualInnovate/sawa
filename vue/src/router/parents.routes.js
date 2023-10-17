// permissions

const Index = () => import("../views/parents/index.vue");

const parentsRoutes = [
  {
    path: "parents",
    name: "Parents",
    component: Index,
    meta: {
      permissions: ["child.index"],
    },
  },
];

export default {
  ...parentsRoutes,
};
