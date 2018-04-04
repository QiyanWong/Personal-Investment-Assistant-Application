/**
 * Created by qiyanwang on 2017/4/16.
 */
import Jama.Matrix;
import org.apache.commons.math3.linear.Array2DRowRealMatrix;
import org.apache.commons.math3.linear.RealMatrix;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Scanner;


public class Bayesian {




        public double Bayes(ArrayList<Double> xinput, ArrayList<Double> tinput, int count ) throws IOException {

            double beta = 11.11;
            double alpha = 0.005;

//---------------input training data-----------------------------------


            double[][] p = new double[3][count];
            MatrixCon.phiMatrix(p, xinput, count);
//----------------------------------------------------------------------

            RealMatrix phi_mat = new Array2DRowRealMatrix(p);
            double[][] aIndx = new double[3][3];
            for (int i = 0; i < 3; i++) {
                aIndx[i][i] = alpha;
            }
            double[] phiTemp = new double[3];
            double[][] phiSum = new double[3][3];

            RealMatrix phiSummat = new Array2DRowRealMatrix(phiSum);

            for (int i = 0; i < count; i++) {
                for (int j = 0; j < 3; j++) {
                    phiTemp[j] = p[j][i];
                }
                RealMatrix phiTemp_mat = new Array2DRowRealMatrix(phiTemp);

                //transpose φ(x): phiTemp_mat.transpose()
                phiSummat = phiSummat.add(phiTemp_mat.multiply(phiTemp_mat.transpose()));
                //phiSummat now equals ∑φ(xn)φ(x)T
            }

            RealMatrix alpha_mat = new Array2DRowRealMatrix(aIndx);
            RealMatrix sInv_mat = alpha_mat.add(phiSummat.scalarMultiply(beta));

            double[][] sInv_array = new double[3][3];
            for (int i = 0; i < 3; i++) {
                for (int j = 0; j < 3; j++) {
                    sInv_array[i][j] = sInv_mat.getEntry(i, j);
                }
            }
            //Matrix S
            Matrix SImat = new Matrix(sInv_array);
            Matrix Smat = SImat.inverse();
            double[][] Sarray = Smat.getArray();

            RealMatrix s_mat = new Array2DRowRealMatrix(Sarray);

            // sum = ∑φ(xn )tn
            double[] temp = new double[3];
            double[] sum = new double[3];

            RealMatrix phySum2 = new Array2DRowRealMatrix(sum);
            for (int i = 0; i < count; i++) {
                for (int j = 0; j < 3; j++) {
                    temp[j] = p[j][i];
                }
                RealMatrix phiTemp2 = new Array2DRowRealMatrix(temp);
                //add with training data to get ∑φ(xn )tn
                phySum2 = phySum2.add(phiTemp2.scalarMultiply(tinput.get(i)));
            }
            RealMatrix phiTmat = phi_mat.transpose();
            RealMatrix meanmat = phiTmat.multiply(s_mat.multiply(phySum2)).scalarMultiply(beta);
            double[][] result = meanmat.getData();
            double result1 = result[count - 1][0];
//            System.out.println(("Price : " + result[count - 1][0]));
            return result1;
        }


}
