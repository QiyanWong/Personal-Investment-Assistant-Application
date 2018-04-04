

import javax.naming.ContextNotEmptyException;
import java.io.FileInputStream;
import java.io.IOException;
import java.util.*;

public class Ann
{
    private static ArrayList<Double> input1= new ArrayList<>();
    private static ArrayList<Double> input2= new ArrayList<>();
    private static ArrayList<Double> hide1= new ArrayList<>();
    private static ArrayList<Double> hide2= new ArrayList<>();
    private static ArrayList<Double> actual_output= new ArrayList<>();
    public static ArrayList<Double> output= new ArrayList<>();
    public int digit = 0;
    public String path;
//    private static double[][] input={{0.822140015,0.821440002},{0.821929993,0.82102002},{0.824710022,0.81702002},{0.825390015,0.82377002}};
//    private static double[] actual_output={0.823559998,0.8243200007,0.823349976,0.824669983};
//    private static double[][] hide=new double[4][2];
    Ann(String path){
        this.path = path;
    }
    Ann(){}
    private static double[] weight1=new double[4];
    private static double[] weight2=new double[2];
    private static double[] bias_wight= new double[3];
    private static double rate = 1,target_error = 0.002;

    private static double f(double x)
    {
        return 1/(1 + Math.exp(-x));
    }

    private static double run(){
        double error = 0;
        for(int i=0;i < input1.size();i++)
        {
            hide1.add(f(weight1[0]*input1.get(i) + weight1[1]*input2.get(i)-bias_wight[0]));
            hide2.add(f(weight1[2]*input1.get(i) + weight1[3]*input2.get(i)-bias_wight[1]));
            output.add(f(weight2[0]*hide1.get(i) + weight2[1]*hide2.get(i)-bias_wight[2]));
            error += (actual_output.get(i)-output.get(i))*(actual_output.get(i)-output.get(i));
        }

        return 0.5 * error;
    }


    private static void weight_correction() {
        final int n1 = input1.size();

        double[][] delta = new double[n1][2];

        //correct hidden layer weight
        for (int i = 0; i < n1; i++) {
            delta[i][0] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[0] * (1 - hide1.get(i)) * hide1.get(i) * input1.get(i);
            delta[i][1] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[0] * (1 - hide1.get(i)) * hide1.get(i) * input2.get(i);
            bias_wight[0] -= rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[1] * (1 - hide2.get(i)) * hide2.get(i);
            weight1[0] += delta[i][0];
            weight1[1] += delta[i][1];
        }

        for (int i = 0; i < n1; i++) {
            delta[i][0] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[1] * (1 - hide2.get(i)) * hide2.get(i) * input1.get(i);
            delta[i][1] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[1] * (1 - hide2.get(i)) * hide2.get(i) * input2.get(i);
            bias_wight[1] -= rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * weight2[1] * (1 - hide2.get(i)) * hide2.get(i);
            weight1[2] += delta[i][0];
            weight1[3] += delta[i][1];
        }

        //correct output layer weight
        for (int i = 0; i < n1; i++) {
            delta[i][0] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * hide1.get(i);
            delta[i][1] = rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i)) * hide2.get(i);
            bias_wight[2] -= rate * (actual_output.get(i) - output.get(i)) * output.get(i) * (1 - output.get(i));
            weight2[0] += delta[i][0];
            weight2[1] += delta[i][1];
        }
    }

    public void train (double[] weight1out,double[] weight2out ) throws IOException {

    Readin.input(path,input1,input2,actual_output,2,3,5);
digit = 10;
    //initialize weight randomly
    for(int i=0;i<4;i++){weight1[i]=Math.random()*-1;}
    for(int j=0;j<2;j++){weight2[j]=Math.random()*-1;}
    for(int k=0;k<3;k++){bias_wight[k]=Math.random()*-1;}
//    System.out.println("Initial Weights:");
//    for(int i=0;i<4;i++){System.out.println(weight1[i]);}
//    for(int i=0;i<2;i++){System.out.println(weight2[i]);}
//    System.out.println("--------------------------");
    run();
    int count = 1;
//    System.out.println("First Batch Error:"+run());


    while(run()>target_error && count < 50000 )
    {

//            System.out.println("error:" + run());
        weight_correction();
        hide1.clear();
        hide2.clear();
        output.clear();
        count++;
//            System.out.println("count:" + count);
    }
    weight1out = weight1;
    weight2out = weight2;


}
    public void predict(ArrayList<Double> input3,ArrayList<Double> input4,ArrayList<Double> out,double[] weight1out, double[] weight2out){
        output.clear();
//        hide1.clear();
//        hide2.clear();
        for(int i=0;i < input3.size();i++)
        {
            hide1.add(f(weight1[0]*input3.get(i) + weight1[1]*input4.get(i)-bias_wight[0]));
            hide2.add(f(weight1[2]*input3.get(i) + weight1[3]*input4.get(i)-bias_wight[1]));
            output.add(f(weight2[0]*hide1.get(i) + weight2[1]*hide2.get(i)-bias_wight[2]));
        }
        out = output;
    }


}