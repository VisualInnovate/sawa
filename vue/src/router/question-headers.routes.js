// permissions

const Index = () => import("../views/QuestionHeaders/Index.vue");
const Show = () => import("../views/QuestionHeaders/Show.vue");
const Edit = () => import("../views/QuestionHeaders/Edit.vue");
const Create = () => import("../views/QuestionHeaders/Create.vue");

const headersRoutes = [
  {
    path: "headers",
    name: "Headers",
    component: Index,
    meta: {
      permissions: ["evaluationheaders.index"],
    },
  },
  // create
  {
    path: "headers/create",
    name: "CreateHeaders",
    component: Create,
    meta: {
      permissions: ["evaluationheaders.create"],
    },
  },
  // show
  {
    path: "headers/:id",
    name: "ShowHeaders",
    component: Show,
    meta: {
      permissions: ["evaluationheaders.show"],
    },
  },
  // edit
  {
    path: "headers/:id/edit",
    name: "EditHeaders",
    component: Edit,
    meta: {
      permissions: ["evaluationheaders.update"],
    },
  },
];

export default {
  ...headersRoutes,
};
