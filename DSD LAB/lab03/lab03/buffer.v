`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date:    20:41:17 03/02/2025 
// Design Name: 
// Module Name:    buffer 
// Project Name: 
// Target Devices: 
// Tool versions: 
// Description: 
//
// Dependencies: 
//
// Revision: 
// Revision 0.01 - File Created
// Additional Comments: 
//
//////////////////////////////////////////////////////////////////////////////////
module decoder2X1(A, B, D);
    input A, B;
    output [3:0] D;

    assign D[0] = ~A & ~B;
    assign D[1] = ~A & B;
    assign D[2] = A & ~B;
    assign D[3] = A & B;
endmodule
