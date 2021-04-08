using System;
using Oracle.ManagedDataAccess.Client;

namespace lab2
{
    class Program
    {
        
        static void Main(string[] args)
        {
            Irepository myRep = new OracleRepository();
            string obj = myRep.CalculationOfCost(new Clients(4, "", "", "", "", "", "", "", 0, 0));
            Console.WriteLine(obj);
            //myRep.AddReviews(new reviews(1, "привет3", 2.5f, "awda241", 4));
            //myRep.UpdateReviews(new Reviews(24, "66 баллов", 5.0f, "QEST21521", 6));
            //myRep.DeleteReviews(new reviews(26, "", 0, "", 0));
            /*var reviews = myRep.GetReviews();
            foreach(var review in reviews)
            {
                Console.WriteLine(review);
            }*/
        }
    }
}
