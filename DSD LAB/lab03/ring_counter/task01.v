`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date:    12:20:52 03/17/2025 
// Design Name: 
// Module Name:    task01 
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
`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date:    10:58:52 03/10/2025 
// Design Name: 
// Module Name:    BCD 
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
//////////////////////////////////////////////////////////////////////////////
module BCDa(
OUT,IN,dp,en
);
input [3:0] IN;
output [6:0] OUT;
input en;
output dp;
assign dp=en;
assign OUT=(IN==4'b0000) ? 7'b1000000:
           (IN==4'b0001) ? 7'b1111001:
		      7'b0000000;
endmodule