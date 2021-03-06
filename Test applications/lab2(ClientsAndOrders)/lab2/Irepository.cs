﻿using System;
using System.Collections.Generic;
using System.Text;

namespace lab2
{
    interface Irepository
    {
        IEnumerable<Reviews> GetReviews();
        bool AddReviews(Reviews newreviews);
        void DeleteReviews(Reviews newrivews);
        bool UpdateReviews(Reviews newreviews);
        string CalculationOfCost(Clients newClients);
        Ienumerable<Clients> GetRatingOutput();
        string PercentToRaiting(Clients newClients);
    }
}
