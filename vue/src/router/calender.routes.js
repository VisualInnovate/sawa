// permissions

const Index = () => import("../views/calender/Index.vue");
const ShowBooking = () => import("../views/calender/ShowBooking.vue");
const BookingDetails = () => import("../views/calender/BookingDetails.vue");

const calenderRoutes = [
  {
    path: "calender",
    name: "Calender",
    component: Index,
  },
  {
    path: "bookings",
    name: "ShowBooking",
    component: ShowBooking,
  },
  {
    path: "bookings/:id/details",
    name: "BookingDetails",
    component: BookingDetails,
    props: true,
  },
];

export default {
  ...calenderRoutes,
};
